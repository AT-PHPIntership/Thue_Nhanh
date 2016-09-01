<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Repositories\Eloquent\PostRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\CityRepositoryEloquent;
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
     * Create a new post controller instance.
     *
     * @param PostRepositoryEloquent $post the post repository eloquent
     */
    public function __construct(PostRepositoryEloquent $post,
                                CategoryRepositoryEloquent $category,
                                UserRepositoryEloquent $user,
                                CityRepositoryEloquent $city)
    {
        $this->post = $post;
        $this->category = $category;
        $this->user = $user;
        $this->city = $city;
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

        $data['categories'] = $this->category->scopeQuery(function($query){
            return $query->orderBy('name','asc');
        })->all();

        $data['currentUser'] = $this->user->find(Auth::user()->id);
        $data['currentUser'] != null ? $data['currentUser'] = $data['currentUser']->profile : null;

        $data['cities'] = $this->city->all();

        // dd(Auth::user()->id, $data['currentUser'], $data['cities']);

        return view('frontend.posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photos = $request->file('photos');
        if (!empty($photos)) {
            foreach ($photos as $photo) {
                \Storage::disk('storage')->put(
                    \Config::get('common.POST_PHOTOS_PATH') . $photo->getClientOriginalName(),
                    file_get_contents($photo)
                );
            }
        }
        dd('OK');
        //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
