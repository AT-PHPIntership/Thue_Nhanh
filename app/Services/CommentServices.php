<?php

namespace App\Services;

use Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentServices
{
    /**
     * Pageginate comments.
     *
     * @param Illuminate\Database\Eloquent\Collection $resource The post's comments
     * @param int                                     $perPage  The number of resource per page
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginate(Collection $resource, $perPage)
    {
        $currentPage = Paginator::resolveCurrentPage() - 1;
        
        $currentSearchResults = $resource->slice($currentPage * $perPage, $perPage)->all();

        return new LengthAwarePaginator($currentSearchResults, count($resource), $perPage);
    }
}
