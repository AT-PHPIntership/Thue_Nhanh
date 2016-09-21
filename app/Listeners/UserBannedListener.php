<?php

namespace App\Listeners;

use App\Events\UserBanned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Eloquent\PostRepositoryEloquent as PostRepo;
use App\Repositories\Eloquent\CommentRepositoryEloquent as CommentRepo;
use App\Repositories\Eloquent\ProfileRepositoryEloquent as ProfileRepo;

class UserBannedListener
{
    protected $post;
    protected $comment;
    protected $profile;

    /**
     * Create the event listener.
     *
     * @param PostRepo    $post    post repository instance
     * @param CommentRepo $comment comment repository instance
     * @param ProfileRepo $profile profile repository instance
     *
     * @return void
     */
    public function __construct(PostRepo $post, CommentRepo $comment, ProfileRepo $profile)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->profile = $profile;
    }

    /**
     * Handle the event.
     *
     * @param UserBanned $event the event
     *
     * @return void
     */
    public function handle(UserBanned $event)
    {
        $id = $event->id;
        $this->profile->hide($id);
        $this->comment->hide($id);
        $this->post->hide($id);
    }
}
