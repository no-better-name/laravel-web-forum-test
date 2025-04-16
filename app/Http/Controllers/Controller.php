<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use ValueError;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function handlePagination(
        Request $request,
        Builder $query,
        array|null $query_params = null,
        array|null $allowed_sort_fields = null,
        array|null $default_vals = null,
        string $page_name = 'page',
        string|array|null $id = null,
    )
    {
        if (is_null($query_params)) {
            $query_params = config('app.key_to_query');
        }
        if (is_null($allowed_sort_fields)) {
            $allowed_sort_fields = config('app.allow_sort');
        }
        if (is_null($default_vals)) {
            $default_vals = config('app.query_default_params');
        }

        if (empty($query_params['sort_by'])) {
            throw new ValueError('The query parameter name for the sort field must be included');
        }
        if (empty($query_params['order'])) {
            throw new ValueError('The query parameter name for the sort order must be included');
        }
        if (empty($query_params['show_count'])) {
            throw new ValueError('The query parameter name for pagination item count must be included');
        }

        if (count($allowed_sort_fields) < 1) {
            throw new ValueError('Allowed fields to sort by must be included');
        }

        if (empty($default_vals['sort_by'])) {
            throw new ValueError('The default sort field must be included');
        }
        if (empty($default_vals['order'])) {
            throw new ValueError('The default sort order must be included');
        }

        if (!in_array($default_vals['sort_by'], $allowed_sort_fields)) {
            throw new ValueError('The default sort field must be allowed');
        }

        $sort_by = strtolower($request->query($query_params['sort_by']));
        $order = strtolower($request->query($query_params['order']));
        $show_count = strtolower($request->query($query_params['show_count']));

        if (!in_array($sort_by, $allowed_sort_fields)) {
            $sort_by = $default_vals['sort_by'];
        }
        if ($order != 'asc' and $order != 'desc') {
            $order = $default_vals['order'];
        }
        if (empty($show_count)) {
            if (array_key_exists('show_count', $default_vals)) {
                $show_count = $default_vals['show_count'];
            } else {
                $show_count = config('app.pagination_item_counts')[0];
            }
        }

        $query = $query->orderBy($sort_by, $order);
        if (empty($id)) {
            $query = $query->orderBy('id', $order);
        } elseif (is_string($id)) {
            $query = $query->orderBy($id, $order);
        } else {
            foreach ($id as $next_id) {
                $query = $query->orderBy($next_id, $order);
            }
        }

        return $query->paginate($show_count, ['*'], $page_name);
    }
}
