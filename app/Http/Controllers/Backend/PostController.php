<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\PostController as FronendPostController;

class PostController extends FronendPostController
{
    /**
     * Get posts haven't reviewed yet.
     *
     * @return \Illuminate\Http\Response
     */
    public function waitCensor()
    {
        $data['posts'] = $this->post->where('reviewed_at', 'null');
        return view('backend.posts.waitcensor')->with($data);
    }
}
