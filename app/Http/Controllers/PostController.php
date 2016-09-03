<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Storage;
use Exception;
use App\Models\Post;
use App\Http\Requests;
use App\Services\PostServices;
use App\Repositories\Eloquent\PostRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\CityRepositoryEloquent;
use App\Repositories\Eloquent\PhotoRepositoryEloquent;
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
     * Create a new post controller instance.
     *
     * @param PostRepositoryEloquent     $post     the post repository eloquent
     * @param CategoryRepositoryEloquent $category the category repository eloquent
     * @param UserRepositoryEloquent     $user     the user repository eloquent
     * @param CityRepositoryEloquent     $city     the city repository eloquent
     * @param PhotoRepositoryEloquent    $photo    the photo repository eloquent
     */
    public function __construct(
        PostRepositoryEloquent $post,
        CategoryRepositoryEloquent $category,
        UserRepositoryEloquent $user,
        CityRepositoryEloquent $city,
        PhotoRepositoryEloquent $photo
    ) {

        $this->post = $post;
        $this->category = $category;
        $this->user = $user;
        $this->city = $city;
        $this->photo = $photo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    /*
    public function show($id)
    {
        //
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id the post id
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
    {
        //
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request the request
     * @param int                      $id      the post id
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function update(Request $request, $id)
    {
        //
    }
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id the post id
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        //
    }
    */
}
