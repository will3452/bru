<?php

namespace App\Nova;

use App\Nova\Actions\ApproveTicket;
use App\Nova\Lenses\ClosedTickets;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Ticket extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Ticket::class;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
    ];

    /**
     * Get the fields displayed by the resource.
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
                ->readonly()
                ->required(),

            Text::make('Type of Work', function ($request) {
                $type = explode('\\', $request->ticketable_type);

                return end($type);
            })
                ->readonly()
                ->exceptOnForms(),

            Text::make('Work ID', 'ticketable_id')
                ->exceptOnForms(),

            Textarea::make('Reason')
                ->readonly()
                ->required(),

            Textarea::make('Request Action', function ($request) {
                if ($request->title == null) {
                    return "Delete Work";
                }
                return "Change Title Work to \" $request->title \" or Change Cost to \" $request->cost \"";
            })
                ->readonly(),

            Text::make('Status')
                ->readonly()
                ->required(),

            Textarea::make('Admin Reason')
                ->readonly()
                ->required(),

            Text::make('Requested Date', function ($request) {
                return $request->created_at->format('m-d-Y');
            })
                ->readonly(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            (new ClosedTickets()),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new ApproveTicket()),
        ];
    }

    public static $with = ['ticketable'];

    public static $group = 'Ticket Management';
}
