<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Event;
use Storage;
use Exception;
use App\Models\Post;
use App\Http\Requests;
use App\Events\PostDeleted;
use App\Services\VoteServices;
use App\Services\PostServices;
use App\Services\CommentServices;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Eloquent\PostRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\CityRepositoryEloquent;
use App\Repositories\Eloquent\VoteRepositoryEloquent;
use App\Repositories\Eloquent\PhotoRepositoryEloquent;
use App\Repositories\Eloquent\CommentRepositoryEloquent;
use App\Repositories\Eloquent\CategoryRepositoryEloquent;

class PostController extends Controller
{
    /**
     * The post Repository eloquent instance.
     *
     * @var PostRepositoryEloquent
     */
    protected $post;

    /**
     * The category Repository eloquent instance.
     *
     * @var CategoryRepositoryEloquent
     */
    protected $category;

    /**
     * The user Repository eloquent instance.
     *
     * @var CategoryRepositoryEloquent
     */
    protected $user;

    /**
     * The city Repository eloquent instance.
     *
     * @var CategoryRepositoryEloquent
     */
    protected $city;

    /**
     * The photo Repository eloquent instance.
     *
     * @var PhotoRepositoryEloquent
     */
    protected $photo;

    /**
     * The comment Repository eloquent instance.
     *
     * @var CommentRepositoryEloquent
     */
    protected $comment;

    /**
     * The vote Repository eloquent instance.
     *
     * @var VoteRepositoryEloquent
     */
    protected $vote;

    /**
     * Create a new post controller instance.
     *
     * @param PostRepositoryEloquent     $post     the post repository eloquent
     * @param CategoryRepositoryEloquent $category the category repository eloquent
     * @param UserRepositoryEloquent     $user     the user repository eloquent
     * @param CityRepositoryEloquent     $city     the city repository eloquent
     * @param PhotoRepositoryEloquent    $photo    the photo repository eloquent
     * @param CommentRepositoryEloquent  $comment  the photo repository eloquent
     * @param VoteRepositoryEloquent     $vote     the vote repository eloquent
     */
    public function __construct(
        PostRepositoryEloquent $post,
        CategoryRepositoryEloquent $category,
        UserRepositoryEloquent $user,
        CityRepositoryEloquent $city,
        PhotoRepositoryEloquent $photo,
        CommentRepositoryEloquent $comment,
        VoteRepositoryEloquent $vote
    ) {

        $this->post = $post;
        $this->category = $category;
        $this->user = $user;
        $this->city = $city;
        $this->photo = $photo;
        $this->comment = $comment;
        $this->vote = $vote;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forRentPosts = $this->post->getPosts(\Config::get('common.FOR_RENT_VAL'));
        $needRentPosts = $this->post->getPosts(\Config::get('common.NEED_RENT_VAL'));

        $data['forRentPosts'] = $forRentPosts->paginate(\Config::get('common.POSTS_PER_PAGE'), ['*'], 'cho_thue');
        $data['needRentPosts'] = $needRentPosts->paginate(\Config::get('common.POSTS_PER_PAGE'), ['*'], 'can_thue');

        return view('frontend.posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['postTypes'] = [
            \Config::get('common.FOR_RENT_VAL')  => trans('frontend.post.create.for_rent'),
            \Config::get('common.NEED_RENT_VAL') => trans('frontend.post.create.need_rent')
        ];

        $data['categories'] = $this->category->scopeQuery(function ($query) {
            return $query->orderBy('name', 'asc');
        })->all();

        $data['currentUser'] = $this->user->find(Auth::user()->id);
        $data['currentUser'] != null ? $data['currentUser'] = $data['currentUser']->profile : null;

        $data['cities'] = $this->city->all();

        return view('frontend.posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request the request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only([
            'category_id', 'city_id', 'address', 'lat', 'lng', 'phone_number', 'type',
            'title', 'content', 'cost', 'time_begin', 'time_end', 'start_date',
            'end_date', 'photos', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun'
        ]);

        $validator = PostServices::creatingValidator($input);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Retrieve selected date and encode to json.
        $weekDays = ['mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun'];
        $chosen = [];
        foreach ($weekDays as $day) {
            $request->has($day) ? $choice = ['date' => $day, 'chosen' => true]
                                : $choice = ['date' => $day, 'chosen' => false];
            array_push($chosen, $choice);
        }
        $choosenDays = json_encode($chosen);

        $input['user_id'] = Auth::user()->id;
        $input['slug'] = str_limit(str_slug($request->title), \Config::get('common.POST_SLUG_LENGTH_LIMIT'), '') . \Config::get('common.URL_SEPARATOR') . time();
        $input['chosen_days'] = $choosenDays;
        // Create the post
        $post = $this->post->create($input);
        // upload post's images
        $this->uploadImage('photos', $post, $request);

        return redirect()->route('post.show', ['slug' => $post->slug]);
    }

    /**
     * Store the uploaded images to `storage\app\public\images\posts\<filename>`.
     *
     * @param string          $fieldName the name of HTML input tag
     * @param App\Models\Post $post      the instance of post repository
     * @param Request         $request   the request
     *
     * @return boolean
     */
    protected function uploadImage($fieldName, Post $post, Request $request)
    {
        try {
            $photos = $request->file($fieldName);
            if (!empty($photos)) {
                $stringName = $post->slug . \Config::get('common.URL_SEPARATOR');
                foreach ($photos as $index => $image) {
                    $index++;
                    $fileName = $stringName . $index . str_random(8) . '.' . $image->getClientOriginalExtension();
                    $filePath = \Config::get('common.POST_PHOTOS_PATH') . $fileName;
                    Storage::disk('storage')->put($filePath, file_get_contents($image));
                    $this->photo->create([
                        'post_id'   => $post->id,
                        'file_name' => $fileName,
                    ]);
                    // resize the file to save storage space.
                    // $this->resize($filePath);
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Resize the uploaded image keep aspect ratio.
     *
     * @param string $filePath The path to image file
     *
     * @return void
     */
    protected function resize($filePath)
    {
        $img = Image::make($filePath);
        $imgW = $img->width();
        $imgH = $img->height();

        if ($imgH > \Config::get('common.IMG_MAX_HEIGHT')) {
            $img->resize(null, \Config::get('common.IMG_MAX_HEIGHT'), function ($constraint) {
                $constraint->aspectRatio();
            });
        } elseif ($imgW > \Config::get('common.IMG_MAX_WIDTH')) {
            $img->resize(\Config::get('common.IMG_MAX_WIDTH'), null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id the post id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->post->with('category')->with('city')->with('reviewer')->with('user')->find($id);

        $comments = $this->comment->with('user')
                                  ->scopeQuery(function ($query) {
                                      return $query->orderBy('created_at', 'desc');
                                  })
                                  ->findByField('post_id', $post->id);
        $countComments = count($comments);

        $comments = CommentServices::paginate($comments, \Config::get('common.COMMENTS_PER_PAGE'));

        $user = null;
        $roles = [];
        $isVote = false;
        if (Auth::user()) {
            $user = $this->user->find(Auth::user()->id);

            $roles = $user->roles->pluck('name');

            $isVote = $this->vote->isVote($post->id, $user->id);
        }

        $roles = PostServices::getRoles($roles);

        $data = [
            'post'          => $post,
            'photos'        => $this->photo->findByField('post_id', $post->id),
            'comments'      => $comments,
            'countComments' => $countComments,
            'votes'         => $this->vote->with('user')->findByField('post_id', $post->id),
            'roles'         => $roles,
            'isAuthor'      => $user ? ($user->id == $post->user_id) : false,
            'isVote'        => $isVote,
        ];
        $data = array_merge($data, $roles);

        return view('frontend.posts.show')->with($data);
    }

    /**
     * Show a specify post via post slug.
     *
     * @param string $category The category title slug
     * @param string $post     The post title slug
     *
     * @return \Illuminate\Http\Response
     */
    public function read($category, $post)
    {
        $post = $this->post->with('category')->findByField(['slug' => $post])->first();
        if ($post && $post->category->slug == $category) {
            return $this->show($post->id);
        }
        abort(\Config::get('common.HTTP_NOT_FOUND'), null);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id the post id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->with('user')
                           ->with('photos')
                           ->find($id);
        $post['chosenDays'] = json_decode($post->chosen_days);
        // dd($post->chosenDays[1]->date);
        $userRoles = $this->user->find(Auth::user()->id)->roles->pluck('name');
        $userRoles = PostServices::getRoles($userRoles);

        if (!$post) {
            return redirect()->back();
        }

        $data['categories'] = $this->category->all();
        $data['cities'] = $this->city->all();
        $data['photos'] = $this->photo->findByField('post_id', $id);
        $author = $post->user->id == Auth::user()->id;

        if ($author || $userRoles['isMod'] || $userRoles['isAdmin'] || $userRoles['isWebmaster']) {
            $data['post'] = $post;
            $data = array_merge($data, $userRoles);

            return view('frontend.posts.edit')->with($data);
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request the request
     * @param int                      $id      the post id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only([
            'category_id', 'city_id', 'address', 'lat', 'lng', 'phone_number', 'type',
            'title', 'content', 'cost', 'time_begin', 'time_end', 'start_date',
            'end_date', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun'
        ]);

        $validator = PostServices::updateingValidator($input);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $chosenDays = $this->makeJsonDays($request);
        $request['chosen_days'] = $chosenDays;

        $post = $this->post->find($id);

        if (!$post) {
            return redirect()->back();
        }
        if ($request->review_status) {
            $request['reviewed_by'] = Auth::user()->id;
            $request['reviewed_at'] = date(\Config::get('common.DATETIME_FORMAT_DB'), time());
        } else {
            $request['reviewed_by'] = null;
            $request['reviewed_at'] = null;
        }
        if ($request->has('closed_at')) {
            $request['closed_at'] = date(\Config::get('common.DATETIME_FORMAT_DB'), time());
        } else {
            $request['closed_at'] = null;
        }
        $updating = $post->update($request->all());

        return $updating ? redirect()->route('post.read', ['category' => $post->category->slug, 'post' => $post->slug])
                         : redirect()->back()->withInput($request->all());
    }

    /**
     * Retrieve choices day then encode json.
     *
     * @param Request $request the request
     *
     * @return json
     */
    protected function makeJsonDays(Request $request)
    {
        $weekDays = ['mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun'];
        $chosen = [];
        foreach ($weekDays as $day) {
            $request->has($day) ? $choice = ['date' => $day, 'chosen' => true]
                                : $choice = ['date' => $day, 'chosen' => false];
            array_push($chosen, $choice);
        }
        return json_encode($chosen);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id the post id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleting = $this->post->delete($id);
        if (!$deleting) {
            return redirect()->back()->withErrors(trans('backend.posts.waitcensor.del_fails'));
        }
        Event::fire(new PostDeleted($id));
        return redirect()->back()->withMessage(trans('backend.posts.waitcensor.del_success'));
    }
}
