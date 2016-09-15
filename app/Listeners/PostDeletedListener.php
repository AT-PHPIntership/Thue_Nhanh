<?php

namespace App\Listeners;

use App\Events\PostDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Repositories\Eloquent\VoteRepositoryEloquent as Vote;
use App\Repositories\Eloquent\PhotoRepositoryEloquent as Photo;
use App\Repositories\Eloquent\CommentRepositoryEloquent as Comment;

class PostDeletedListener
{
    protected $vote;
    protected $photo;
    protected $comment;

    /**
     * Create the event listener.
     *
     * @param Vote    $vote    the vote repository eloquent
     * @param Photo   $photo   the photo repository eloquent
     * @param Comment $comment the comment repository eloquent
     *
     * @return void
     */
    public function __construct(Vote $vote, Photo $photo, Comment $comment)
    {
        $this->vote = $vote;
        $this->photo = $photo;
        $this->comment = $comment;
    }

    /**
     * Handle the event.
     *
     * @param PostDeleted $event post deleted event
     *
     * @return void
     */
    public function handle(PostDeleted $event)
    {
        $id = $event->id;
        $this->vote->delete($id);
        $this->photo->delete($id);
        $this->comment->delete($id);
    }
}
