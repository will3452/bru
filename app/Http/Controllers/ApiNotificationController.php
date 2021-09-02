<?php

namespace App\Http\Controllers;

class ApiNotificationController extends Controller
{
    public function get()
    {
        $notifications = collect([
            [
                'type' => 'announcement',
                'message' => 'lorem ipsum dolor set',
                'more' => '',
            ],
            [
                'type' => 'announcement 2',
                'message' => 'lorem ipsum dolor set',
                'more' => '',
            ],
            [
                'type' => 'announcemen 3',
                'message' => 'lorem ipsum dolor set',
                'more' => '',
            ],
            [
                'type' => 'announcemen 4',
                'message' => 'lorem ipsum dolor set',
                'more' => '',
            ],
        ]);

        return response([
            'notifications' => $notifications,
            'result' => 200,
        ], 200);
    }
}
