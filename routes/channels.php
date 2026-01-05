<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

Log::info('🔥 channels.php FILE LOADED');

Broadcast::channel('customers.online', function ($user) {
    Log::info('🔥 Presence auth hit', [
        'user_id' => $user?->id,
        'role' => $user?->role,
    ]);

    return true;
});
