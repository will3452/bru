<?php

namespace App\Nova;

use App\Character;
use App\Nova\Filters\MessageFilter;
use App\User;
use Epartment\NovaDependencyContainer\HasDependencies;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;

class Message extends Resource
{

    use HasDependencies;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Message::class;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
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
        'subject',
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
            Text::make('Subject')
                ->required(),

            Select::make('Character')
                ->options(Character::get()->pluck('name', 'name'))
                ->required(),

            Select::make('Sender', function ($request) {
                if ($request->sender_id) {
                    return !User::find($request->sender_id) ?: User::find($request->sender_id)->full_name;
                } else {
                    return !User::find($request->admin_sender_id) ?: User::find($request->admin_sender_id)->full_name;
                }
            })
                ->exceptOnForms(),

            Select::make('Receipient', function ($request) {
                if ($request->receiver_id) {
                    return !User::find($request->receiver_id) ?: User::find($request->receiver_id)->full_name;
                } else {
                    return !User::find($request->admin_receiver_id) ?: User::find($request->admin_receiver_id)->full_name;
                }
            })
                ->exceptOnForms(),

            CKEditor5Classic::make('body')
                ->required()
                ->options([
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                ]),

            Boolean::make('Allow Reply ?', 'replyable')
                ->required()
                ->default(function () {
                    return false;
                }),
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
        return [
            MessageFilter::make(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
