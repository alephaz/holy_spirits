<?php

namespace Adlux\MultiDateSelector;

use Laravel\Nova\Fields\Field;

class MultiDateSelector extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'multi-date-selector';


    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta([
            'shan' => 'ela kollek'
        ]);

    }


    /**
     * Set the date format (Moment.js) that should be used to display the date.
     *
     * @param  string $format
     * @return $this
     */
    public function format($format)
    {
        return $this->withMeta(['format' => $format]);
    }

}
