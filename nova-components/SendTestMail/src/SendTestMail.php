<?php

namespace Adlux\SendTestMail;

use Laravel\Nova\Fields\Field;

class SendTestMail extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'send-test-mail';

    /**
     * Create a new field.
     *
     * @param  string|null  $name
     * @param  string|null  $attribute
     * @param  mixed|null  $resolveCallback
     * @return void
     */
    public function __construct($name = null, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
    }
}
