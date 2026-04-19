<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('chat.{conversation}', function ($user, Conversation $conversation) {
//     return (int) $user->id === (int) $conversation->donor_id
//         || (int) $user->id === (int) $conversation->beneficiary_id;
// });
