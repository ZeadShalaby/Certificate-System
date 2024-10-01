<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SlackAlertNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    //
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function sendAlert(Request $request)
    {
        $message = $request->input('message', 'Default alert message');
        // Assuming you have a user to notify
        $user = User::first(); // Replace with your logic

        $user->notify(new SlackAlertNotification($message));

        return response()->json(['status' => 'Alert sent to Slack']);
    }
}
