<?php

namespace App\View\Components\Backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    public $notifications;

    public $newCount;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $user = Auth::user('user');
        
        $this->notifications = $user->notifications()->take(10)->get(); 

        $this->newCount = $user->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.notification-menu');
    }
}
