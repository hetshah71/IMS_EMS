<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use Illuminate\Support\Facades\Log;

Log::info('Broadcast channel chat.{senderId}.{recipientId}');
Broadcast::channel('chat.{senderId}.{recipientId}', function (User $user, $senderId, $recipientId) {
    return in_array($user->id, [$senderId, $recipientId]);
});
