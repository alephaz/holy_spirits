<?php

namespace App\Nova;

use Adlux\CustomVideo\CustomVideo;
use Adlux\VideoField\VideoField;

use App\Nova\Filters\VideoTypeFilter;
use Benjaminhirsch\NovaSlugField\Slug;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use MrMonat\Translatable\Translatable;
use Tanjemark\Fields\Vimeo;

class Video extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Video';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'slug';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'type'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Select::make('Language', 'language')
                ->options([
                    'en' => 'English',
                    'es' => 'Español',
                    'iw' => 'Hebrew',
                    'neutral' => 'Common'
                ])
                ->rules('required')
                ->displayUsing(function ($e) {
                    return $e === 'neutral' ? 'Common' : strtoupper($e);
                })
                ->sortable(),

            Translatable::make('Title')
                ->singleLine()
                ->creationRules('required'),

            Translatable::make('Description')->trix()->hideFromIndex(),

            Slug::make('Slug')->creationRules('required')->hideFromIndex(),

            Select::make('Type', 'type')->options([
                'youtube' => 'YouTube',
                'vimeo' => 'Vimeo',
                'custom' => 'Custom'
            ])->creationRules('required')->sortable(),

            new Panel('YouTube', [
                File::make('Youtube image', 'youtube_image')
                    ->store(function (Request $request, $model) {
                        $model->addMediaFromRequest('youtube_image')->toMediaCollection('youtube_image');
                    })
                    ->preview(function () {
                        return $this->getFirstMediaUrl('youtube_image');
                    })
                    ->thumbnail(function () {

                        return $this->getFirstMediaUrl('youtube_image');
                    })
                    ->delete(function (Request $request, $model) {

                        $media = $this->getFirstMedia('youtube_image');

                        if ($media->delete()) {
                            return true;
                        }

                        return false;
                    })
                    ->deletable(true)->hideFromIndex(),

                VideoField::make('YouTube Link', 'youtube_link')
                    ->help('If the URL is valid, the youtube video will appear next to the field.')
                    ->hideFromIndex(),
            ]),

            new Panel('Video', [

                File::make('Video image', 'custom_video_image')
                    ->hideFromIndex()
                    ->store(function (Request $request, $model) {
                        $model->addMediaFromRequest('custom_video_image')->toMediaCollection('custom_video_image');
                    })
                    ->preview(function () {
                        return $this->getFirstMediaUrl('custom_video_image');
                    })
                    ->thumbnail(function () {

                        return $this->getFirstMediaUrl('custom_video_image');
                    })
                    ->delete(function (Request $request, $model) {

                        $media = $this->getFirstMedia('custom_video_image');

                        if ($media->delete()) {
                            return true;
                        }

                        return false;
                    })
                    ->deletable(true)->hideFromIndex(),


                CustomVideo::make('Video', 'video_link')
                    ->help('Please be careful when uploading large files since this will not be playable if the file site is large.')
                    ->disk('videos')
                    ->hideFromIndex()
                    ->delete(function (Request $request, $model) {

                        if (!$model->video_link) {
                            return;
                        }

                        Storage::disk('videos')->delete($model->video_link);

                        return [
                            'video_link' => null
                        ];
                    }),
            ]),

            new Panel('Vimeo', [

                Textarea::make('Vimeo', 'vimeo_link'),

            ]),

            Text::make('Location'),

            Country::make('Country', 'country')
                ->hideFromIndex(),

            Number::make('Order', 'weight'),
//
//            Select::make('Country', 'country_id')
//                ->options($this->getCountries())
//                ->creationRules('required'),

            BelongsToMany::make('Channels')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new VideoTypeFilter()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    private function getCountries(): array
    {
        $countries = (new Country())->get();

        if ($countries && $countries->count()) {
            return $countries->pluck('name', 'id')->toArray();
        }

        return [];

    }

}
