<?php

namespace App\Jobs;

use App\Mail\FormCreatedNotification;
use App\Models\Form;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendFormCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $notificationEmail = config('app.notification_email'); 

        if (!empty($notificationEmail)) {
            Mail::to($notificationEmail)->send(new FormCreatedNotification($this->form));
        } else {
            // Log an error if the notification email is not configured
            Log::error('Notification email is not configured in .env for form creation alert.');
        }
    }
}
