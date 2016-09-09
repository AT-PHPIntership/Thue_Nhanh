<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Auth;

use App\Http\Requests;
use App\Repositories\Eloquent\VoteRepositoryEloquent;

class VoteController extends Controller
{
    /**
     * The vote repository eloquent instance.
     *
     * @var VoteRepositoryEloquent
     */
    protected $vote;

    /**
     * Create a new post controller instance.
     *
     * @param CommentRepositoryEloquent $vote the photo repository eloquent
     */
    public function __construct(VoteRepositoryEloquent $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Create or destroy a vote.
     *
     * @param \Illuminate\Http\Request $request the request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userId = Auth::user()->id;

        $vote = $this->vote->with('user')->findByField('post_id', $request->post_id)->where('user_id', $userId)->first();

        if ($request->ajax()) {
            if ($vote) {
                $deleting = $this->destroy($vote->id, $request);

                return $deleting ? response()->json(['responseText' => trans('frontend.vote.success')], Config::get('common.HTTP_CREATED_STATUS'))
                                 : response()->json(['responseText' => trans('frontend.vote.fails')], Config::get('common.HTTP_BAD_REQUEST_STATUS'));
            } else {
                $vote = null;

                if (Auth::user()) {
                    $vote = $this->store($request);
                }

                return $vote ? response()->json(['responseText' => trans('frontend.vote.success')], Config::get('common.HTTP_CREATED_STATUS'))
                             : response()->json(['responseText' => trans('frontend.vote.fails')], Config::get('common.HTTP_BAD_REQUEST_STATUS'));
            }
        }
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
        if ($request->ajax()) {
            return $this->vote->create([
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int                      $id      the id of user
     * @param \Illuminate\Http\Request $request the request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax()) {
            return $this->vote->delete($id);
        }
    }
}
