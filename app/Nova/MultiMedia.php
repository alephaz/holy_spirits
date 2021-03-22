<?php

namespace App\Nova;

use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use MrMonat\Translatable\Translatable;

class MultiMedia extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\MultiMedia';

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
        'title'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Translatable::make('MultiMedia Title', 'title')
                ->singleLine()
                ->creationRules('required'),

            Translatable::make('Description'),

            Select::make('File Type', 'type')
                ->options([
                    'file' => 'File',
                    'book' => 'Book',
                    'photo' => 'Photo',
                    'audio' => 'Audio',
                    'video' => 'Video'
                ])
                ->creationRules('required'),

            File::make('File', 'data')->creationRules('required'),

            File::make('Thumbnail', 'thumb')
                ->store(function (Request $request, $model) {
                    $model->addMediaFromRequest('thumb')->toMediaCollection('thumb_image');
                })
                ->preview(function () {
                    return $this->getFirstMediaUrl('thumb_image');
                })
                ->thumbnail(function () {

                    return $this->getFirstMediaUrl('thumb_image');
                })
                ->delete(function (Request $request, $model) {

                    $media = $this->getFirstMedia('thumb_image');

                    if ($media->delete()) {
                        return true;
                    }

                    return false;
                })
                ->deletable(true)->hideFromIndex(),

            Select::make('Language', 'language')
            ->options([
                'en' => 'English',
                'es' => 'Espanol'
            ])
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Change the resource name
     *
     * @return string|void
     */
    public static function label()
    {
        return 'Multimedia';
    }
}
