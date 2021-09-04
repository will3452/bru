<?php

namespace App\Nova;

use App\SongGenre;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Song extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Song::class;

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
        'id', 'title',
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
            Text::make('Title')
                ->required(),

            Text::make('Artist')
                ->required(),

            Textarea::make('Description')
                ->required(),

            Select::make('Cost Type')
                ->options([
                    'purple' => 'Purple Crystal',
                    'white' => 'White Crystal',
                ])
                ->onlyOnDetail()
                ->displayUsingLabels(),

            Select::make('Genre')
                ->options(SongGenre::get()->pluck('name', 'name'))
                ->required(),

            Number::make('Cost')
                ->required()
                ->onlyOnDetail(),

            Image::make('Cover')
                ->disk('nova')
                ->disableDownload()
                ->onlyOnDetail()
                ->required(),

            File::make('File')
                ->required()
                ->disableDownload(),

            Textarea::make('Credits')
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
