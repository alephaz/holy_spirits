<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPasswordReset extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields $fields
     * @param  \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {

            if ($model->email) {

                // get the first part of the email
                $email_start = explode('@', $model->email);

                if (!empty($email_start)) {

                    // create password string
                    $password = $email_start[0] . '_holyspirit';

                    // update the password
                    $model->password = Hash::make($password);

                    // save the updated model
                    $model->save();

                    // send mail
                    $model->notify((new \App\Notifications\NewUserRegistered($model, $password)));
                }

            }

        }

        return Action::message('Password reset email/s sent');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }

    public function name()
    {
        return 'Send Password Reset';
    }
}
