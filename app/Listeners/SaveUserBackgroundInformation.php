<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\Detail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\UserService;

class SaveUserBackgroundInformation
{
    protected $userService;

    /**
     * Create the event listener.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $this->userService->saveUserDetails($event->user);
    }
}
