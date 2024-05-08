<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function updateCollection(UpdateNotificationRequest $request)
    {
        $data = $request->validated();
        Notification::whereIn('id', $data['ids'])->update([
            'is_read' => true
        ]);

        return response()->json([
            'count' => auth()->user()->notifications()->count()
        ]);
    }
}
