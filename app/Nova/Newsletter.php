<?php

namespace App\Nova;

use Adlux\SendTestMail\SendTestMail;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\File;

class Newsletter extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Newsletter';

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

            new Panel('Send Test Mail', [
                SendTestMail::make()
                    ->onlyOnDetail()
            ]),

            Text::make('Title')
                ->rules('required')
                ->help('Message subject'),

            Select::make('Language')
                ->options([
                    'en' => 'English',
                    'es' => 'Español',
                    'neutral' => 'Common'
                ]),

            new Panel('Block A', $this->getBlockFields('a')),

            new Panel('Block B', $this->getBlockFields('b')),

            new Panel('Block C', $this->getBlockFields('c'))
        ];
    }

    /**
     * Get the fields for the content
     * @param string $block_id
     * @return array
     */
    private function getBlockFields(string $block_id): array
    {

        return [
            Text::make('Block ' . strtoupper($block_id) . ' Text', 'block_' . $block_id . '_title')
                ->hideFromIndex()
                ->help('Block "' . strtoupper($block_id) . '" title which will be displayed on top of the block'),

            Trix::make('Block ' . strtoupper($block_id) . ' Body', 'block_' . $block_id . '_body')
                ->hideFromIndex()
                ->help('Block "' . strtoupper($block_id) . '" body, this is the content area for the block'),

            Select::make('Block ' . strtoupper($block_id) . ' Video', 'block_' . $block_id . '_video')
                ->hideFromIndex()
                ->options($this->videoList())
                ->displayUsing(function ($id) {

                    // get the video for the ID
                    $video = (new \App\Models\Video())->find($id);

                    if ($video) {
                        return $video->title;
                    }

                    return '-';
                })
                ->help('Block "' . strtoupper($block_id) . '" video, please select the video from the list above'),

            File::make('Block ' . strtoupper($block_id) . ' Image', 'block_' . $block_id . '_image')
                ->store(function (Request $request, $model) use ($block_id) {

                    $model
                        ->addMediaFromRequest('block_' . $block_id . '_image')
                        ->toMediaCollection('block_' . $block_id . '_image');

                })
                ->preview(function () use ($block_id) {

                    return $this->getFirstMediaUrl('block_' . $block_id . '_image');

                })
                ->thumbnail(function () use ($block_id) {

                    return $this->getFirstMediaUrl('block_' . $block_id . '_image');

                })
                ->delete(function (Request $request, $model) use ($block_id) {

                    $media = $this->getFirstMedia('block_' . $block_id . '_image');

                    if ($media->delete()) {
                        return true;
                    }

                    return false;
                })
                ->deletable(true)
                ->hideFromIndex(),

            Text::make('Block ' . strtoupper($block_id) . ' Link', 'block_' . $block_id . '_image_link')
                ->hideFromIndex()
                ->help('Block "' . strtoupper($block_id) . '" image link, this link will wrap the image on the newsletter body'),

            Text::make('Block ' . strtoupper($block_id) . ' Button Link', 'block_' . $block_id . '_link')
                ->hideFromIndex()
                ->help('Block "' . strtoupper($block_id) . '" link, this link will appear as a button on the email body'),
        ];
    }

    /**
     * Get the current video list
     * @return mixed
     */
    private function videoList()
    {
        // get all the youtube videos
        $youtube_videos = (new \App\Models\Video())->where('type', 'youtube');

        // get the video list
        return $youtube_videos->get()->pluck('title', 'id')->prepend('None', 0);
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
}
