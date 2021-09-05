<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class UserFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($value == 'blocked') {
            return $query->where('disabled', true);
        } else if ($value == 'not_blocked') {
            return $query->where('disabled', false);
        }
        return $query->where('role', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Not Blocked' => 'not_blocked',
            'Blocked' => 'blocked',
            'Author' => 'author',
            'Artist' => 'artist',
            'Student' => 'student',
        ];
    }
}
