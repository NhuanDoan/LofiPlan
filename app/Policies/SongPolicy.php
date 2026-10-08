<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\User;

class SongPolicy
{
    public function update(User $user, Song $song): bool
    {
        return $song->user_id === $user->id;
    }

    public function delete(User $user, Song $song): bool
    {
        return $this->update($user, $song);
    }
}
