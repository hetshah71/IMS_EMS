<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{senderId}.{recipientId}', function (User $user, $senderId, $recipientId) {
    return (int) $user->id === (int) $senderId || (int) $user->id === (int) $recipientId;
    // return true;
});
