<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VideoChannel;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the video channel.
     *
     * @param  \App\Models\User $user
     * @param VideoChannel $videoChannel
     * @return mixed
     */
    public function view(User $user, VideoChannel $videoChannel)
    {
        if (
            // check if the video channel do not have any roles attached to it
            ($videoChannel->roles && !$videoChannel->roles->count()) ||
            // or check if the active user is an administrator
            $user->can('viewAdministration')
        ) {
            return true;
        }

        // check if the user has the same role as the video channel
        if ($videoChannel->roles && $videoChannel->roles->count()) {

            // loop through the role list of the channel to validate with the users roles
            foreach ($videoChannel->roles as $role) {

                // check if the user has this role attached to the user model
                return $user->hasRole($role);
            }
        }
    }

    /**
     * Determine whether the user can create video channels.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('viewAdministration');
    }

    /**
     * Determine whether the user can update the video channel.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\VideoChannel $videoChannel
     * @return mixed
     */
    public function update(User $user, VideoChannel $videoChannel)
    {
        return $user->can('viewAdministration');
    }

    /**
     * Determine whether the user can delete the video channel.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\VideoChannel $videoChannel
     * @return mixed
     */
    public function delete(User $user, VideoChannel $videoChannel)
    {
        return $user->can('viewAdministration');
    }

    /**
     * Determine whether the user can restore the video channel.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\VideoChannel $videoChannel
     * @return mixed
     */
    public function restore(User $user, VideoChannel $videoChannel)
    {
        return $user->can('viewAdministration');
    }

    /**
     * Determine whether the user can permanently delete the video channel.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\VideoChannel $videoChannel
     * @return mixed
     */
    public function forceDelete(User $user, VideoChannel $videoChannel)
    {
        return $user->can('viewAdministration');
    }
}
