<?php
namespace App\Http\Helpers;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CollectionHelper
{
    /**
     * helper function to paginate collections
     *
     * @param \Illuminate\Support\Collection $collection
     * @param int $count
     * @param int $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginate(Collection $collection, $count, $pageSize)
    {
        $page = Paginator::resolveCurrentPage('page');

        return self::paginator($collection->forPage($page, $pageSize), $count, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int  $count
     * @param  int  $perPage
     * @param  int  $currentPage
     * @param  array  $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }
}
