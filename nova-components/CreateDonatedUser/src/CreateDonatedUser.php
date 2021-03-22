<?php

namespace Adlux\CreateDonatedUser;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class CreateDonatedUser extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'create-donated-user';

    public function users(array $users)
    {
        return $this->withMeta(['users' => $users]);
    }
}
