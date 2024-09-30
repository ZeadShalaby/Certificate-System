<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class verifyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users;
    public function __construct(User $user)
    {
        //
        $this->users = $user;
        $this->updateVieweer($this->users);

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    function updateVieweer($users)
    {

        $users->email_verified_at = Carbon::now();
        $users->save();
    }
}
