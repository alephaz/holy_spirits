<?php

namespace Adlux\CustomVideo;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\File;

class CustomVideo extends File
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'custom-video';
}
