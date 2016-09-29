<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CityCriteria
 * @package namespace App\Criteria;
 */
class CityCriteria implements CriteriaInterface
{
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
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
        $model = $model->where('city_id', $this->id);
        return $model;
    }
}
