<?php

namespace App\Http\Controllers;

class ApiNotificationController extends Controller
{
    public function get()
    {
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

        return response([
            'notifications' => $notifications,
            'result' => 200,
        ], 200);
    }
}
