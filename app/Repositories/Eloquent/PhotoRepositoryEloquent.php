<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PhotoRepository;
use App\Models\Photo;
use App\Validators\PhotoValidator;
use Storage;
use Config;

/**
 * Class PhotoRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PhotoRepositoryEloquent extends BaseRepository implements PhotoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Photo::class;
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
     * Delete photos of the post on the database.
     *
     * @param int $postID the specify post
     *
     * @return boolean
     */
    public function delete($postID)
    {
        $result = true;
        $photos = $this->model->where('post_id', $postID);
        if (!$photos) {
            return $result;
        }
        foreach ($photos as $photo) {
            // This is soft deleting, so the cleanFile() function wasn't called.
            // $cleaning = $this->cleanFile($photo->file_name);
            $deleting = $photo->delete();
            if (!$deleting) {
                $result = false;
            }
        }
        return $result;
    }

    /**
     * Delete photos of the post on disk.
     *
     * @param string $fileName the file name
     *
     * @return boolean
     */
    protected function cleanFile($fileName)
    {
        $filePath = Config::get('common.POST_PHOTOS_PATH') . $fileName;
        return Storage::disk('storage')->delete($filePath);
    }
}
