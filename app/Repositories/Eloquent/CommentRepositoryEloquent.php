<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CommentRepository;
use App\Models\Comment;
use App\Validators\CommentValidator;

/**
 * Class CommentRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     *
     * @return void
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Remove comments of the specified post.
     *
     * @param int $postID the post's id
     *
     * @return boolean
     */
    public function delete($postID)
    {
        $result = true;
        $comments = $this->model->where('post_id', $postID);
        if ($comments) {
            foreach ($comments as $comment) {
                $deleting = $comment->delete();
                if (!$deleting) {
                    $result = false;
                }
            }
        }
        return $result;
    }

    /**
     * Hide (soft delete) all commoment of user who was banned.
     *
     * @param int $userID the user's id
     *
     * @return void
     */
    public function hide($userID)
    {
        $comments = $this->model->where('user_id', $userID)->get();
        if ($comments) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }
    }
}
