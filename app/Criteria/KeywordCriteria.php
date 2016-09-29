<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class KeywordCriteria
 * @package namespace App\Criteria;
 */
class KeywordCriteria implements CriteriaInterface
{
    protected $keyword;

    public function __construct($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model->where('title', 'like', "%$this->keyword%")
              ->orWhere('content', 'like', "%$this->keyword%");
        return $model;
    }

}
