<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Auth;

use App\Http\Requests;
use App\Http\Requests\CommentRequest;
use App\Repositories\Eloquent\CommentRepositoryEloquent;

class CommentController extends Controller
{

    /**
     * The comment Repository eloquent instance.
     *
     * @var CommentRepositoryEloquent
     */
    protected $comment;

    /**
     * Create a new post controller instance.
     *
     * @param CommentRepositoryEloquent $comment the photo repository eloquent
     */
    public function __construct(CommentRepositoryEloquent $comment)
    {
        $this->comment = $comment;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request the creating comment request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        if ($request->ajax()) {
            $comment = $this->comment->create($request->all());

            return $comment ? response()->json(['commentID' => $comment->id], Config::get('common.HTTP_CREATED_STATUS'))
                            : response()->json(['responseText' => trans('frontend.comment.create.fails')], Config::get('common.HTTP_BAD_REQUEST_STATUS'));
        }

        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request the request
     * @param int     $id      the comment id
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function show(Request $request, $id)
    {
        //
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
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
     * @param \Illuminate\Http\Request $request the request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $deleting = $this->comment->delete($request->id);
            return $deleting ? response()->json(['commentID' => $request->id], Config::get('common.HTTP_CREATED_STATUS'))
                             : response()->json(['responseText' => trans('frontend.comment.delete.fails')], Config::get('common.HTTP_BAD_REQUEST_STATUS'));
        }
    }
}
