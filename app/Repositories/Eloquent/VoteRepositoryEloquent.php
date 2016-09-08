<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VoteRepository;
use App\Models\Vote;
use App\Validators\VoteValidator;

/**
 * Class VoteRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class VoteRepositoryEloquent extends BaseRepository implements VoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vote::class;
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
     * Check if a user voted for a post.
     *
     * @param int $post the post's id
     * @param int $id   the user's id
     *
     * @return boolean
     */
    public function isVote($post, $id)
    {
        return $this->model->with('user')->where('post_id', $post)
                           ->where('user_id', $id)
                           ->first() ? true : false;
    }
}
