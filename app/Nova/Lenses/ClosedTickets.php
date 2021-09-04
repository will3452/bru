<?php

namespace App\Nova\Lenses;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class ClosedTickets extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->where('status', '!=', 'pending')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('User')
                ->displayUsing(function ($request) {
                    return $request->full_name;
                })
                ->required(),

            Text::make('Type of Work', function ($request) {
                $type = explode('\\', $request->ticketable_type);

                return end($type);
            })
                ->exceptOnForms(),

            Text::make('Work ID', 'ticketable_id')
                ->exceptOnForms(),

            Textarea::make('Reason')
                ->required(),

            Text::make('Status')
                ->required(),

            Textarea::make('Admin Reason')
                ->hideFromIndex()
                ->readonly()
                ->required(),

            Text::make('Requested Date', function ($request) {
                return $request->created_at->format('m-d-Y');
            }),

            Text::make('Ticket Closed Date', function ($request) {
                return $request->updated_at->format('m-d-Y');
            }),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'closed-tickets';
    }
}
