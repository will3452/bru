<?php

namespace App\Nova;

use App\Nova\Actions\BlockUsers;
use App\Nova\Actions\UnblockUsers;
use App\Nova\Filters\UserFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

    // public static function authorizedToCreate(Request $request)
    // {
    //     return false;
    // }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'full_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'first_name', 'last_name', 'email',
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

            Text::make('AAN', 'aan_string')
                ->exceptOnForms()
                ->onlyOnDetail()
                ->sortable(),

            Text::make('First Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Last Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Boolean::make('Blocked', function ($request) {
                return !$request->disabled;
            })
                ->required(),

            Select::make('User Type', 'role')
                ->options([
                    'author' => 'author',
                    'artist' => 'artist',
                    'student' => 'student',
                ])
                ->rules('required'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            MorphToMany::make('Roles', 'roles', Role::class),
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
            (new UserFilter()),
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
        return [
            (new BlockUsers()),
            (new UnblockUsers()),
        ];
    }

    public static $group = 'User Management';

    public static $with = ['aan'];
}
