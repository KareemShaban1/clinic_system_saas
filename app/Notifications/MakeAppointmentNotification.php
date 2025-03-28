<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MakeAppointmentNotification extends Notification
{
    use Queueable;

    private $reservation;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        //
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // configurations for database channel
    public function toDatabase($notifiable)
    {
        $reservation = $this->reservation;

        return [
           'data'=>[
            'body' => " تم طلب حجز بواسطة المريض {$reservation->patient->name}",
            'icon' => 'fas fa-file',
            'url' => url('/backend/dashboard'),
           ],
           'clinic_id' => $reservation->clinic_id
            
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $reservation = $this->reservation;

        return [
           'data'=>[
            'body' => " تم طلب حجز بواسطة المريض {$reservation->patient->name}",
            'icon' => 'fas fa-file',
            'url' => url('/backend/dashboard'),
           ],
           'clinic_id' => $reservation->clinic_id
            
        ];
    }
}
