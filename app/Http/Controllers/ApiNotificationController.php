<?php

namespace App\Http\Controllers;

use App\User;

class ApiNotificationController extends Controller
{
    public function get()
    {
        $user = User::find(auth()->user()->id);

        $notifications = collect([
            [
                'type' => 'announcement',
                'message' => 'lorem ipsum dolor set 1',
                'more' => '',
                'date' => now()->diffForHumans(),
            ],
            [
                'type' => 'announcement 2',
                'message' => 'lorem ipsum dolor set 2',
                'more' => '',
                'date' => now()->diffForHumans(),
            ],
            [
                'type' => 'announcemen 3',
                'message' => 'lorem ipsum dolor set 3',
                'more' => '',
                'date' => now()->diffForHumans(),
            ],
            [
                'type' => 'announcemen 4',
                'message' => 'lorem ipsum dolor set 4',
                'more' => '',
                'date' => now()->diffForHumans(),
            ],
        ]);

        if ($user->notif_mute == 'off') {
            return response([
                'notifications' => [],
                'result' => 200,
            ], 200);
        }

        return response([
            'notifications' => $notifications,
            'result' => 200,
        ], 200);
    }
}
