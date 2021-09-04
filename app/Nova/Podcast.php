<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Podcast extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Podcast::class;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
            Text::make('title')
                ->required(),

            Text::make('Host')
                ->required(),

            Image::make('cover')
                ->disk('nova')
                ->required()
                ->onlyOnDetail()
                ->disableDownload(),

            Textarea::make('Description', 'desc')
                ->required(),

            File::make('Audio Description', 'audio_desc')
                ->required(),

            Select::make('Episode Type')
                ->required()
                ->options([
                    'premium' => 'premium',
                    'regular' => 'regular',
                ]),

            Text::make('Cost', function ($request) {
                $crystal = $request->episode_type != 'premium' ? 'Hall Pass(es)' : 'Purple Crystal(s)';

                return "$request->cost $crystal";
            })
                ->required(),

            File::make('File')
                ->required(),

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

    public static $group = 'Works Management';
}
