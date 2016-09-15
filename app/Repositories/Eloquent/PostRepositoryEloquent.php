<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PostRepository;
use App\Models\Post;
use App\Validators\PostValidator;

/**
 * Class PostRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
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
     * Get all post by post type.
     *
     * @param int $type The type of posts
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function getPosts($type)
    {
        return $this->model->with('photos')
                    ->with('category')
                    ->with('votes')
                    ->with('city')
                    ->where('type', $type)
                    ->whereNotNull('reviewed_by')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Get posts with the condition.
     *
     * @param string $field the table field
     * @param string $value given value
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function where($field, $value)
    {
        return $this->model->with('category')
                    ->with('city')
                    ->with('user')
                    ->having($field, $value)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
