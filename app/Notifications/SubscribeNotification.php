<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Enums\FormType;

class SubscribeNotification extends Notification
{
    use Queueable;
    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $relation = 'student';
        $studentName = $this->details->student->name ?? null;

        // تحديد العلاقة والاسم حسب form_type
        if ($this->details->form_type == FormType::STOPPED_STUDENTS) {
            $relation = 'stoppedStudent';
            $studentName = $this->details->stoppedStudent->student->name ?? null;
        }

        if ($this->details->form_type == FormType::NEW_STUDENTS) {
            $relation = 'newStudent';
            $studentName = $this->details->newStudent->first_name . ' ' . 
                          $this->details->newStudent->father_name . ' ' . 
                          $this->details->newStudent->grandfather_name . ' ' . 
                          $this->details->newStudent->family_name;
        }

        if ($this->details->payment_method == 'hsbc'){
            return (new MailMessage())
                ->from('no-reply@furqangroup.com')
                ->subject('عملية اشتراك جديدة - ' . $studentName)
                ->view('emails.new-bank-subscribe', ['details' => $this->details]);
        }

        if (($this->details->payment_method == 'checkout_gateway' || $this->details->payment_method == 'paypal') && 
            is_numeric($this->details->response_code) && 
            in_array($this->details->payment_status, ['Captured', 'Authorized'])) {
            return (new MailMessage())
                ->from('no-reply@furqangroup.com')
                ->subject('عملية اشتراك جديدة - ' . $studentName)
                ->view('emails.new-card-subscribe', ['details' => $this->details]);
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
