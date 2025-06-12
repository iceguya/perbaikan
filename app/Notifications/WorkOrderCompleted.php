<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WorkOrderCompleted extends Notification
{
    use Queueable;

    protected $serviceRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(ServiceRequest $serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Kita akan simpan notifikasi ke database
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // Data yang akan disimpan di kolom 'data' pada tabel notifications
        return [
            'service_request_id' => $this->serviceRequest->id,
            'technician_name' => $this->serviceRequest->technician->name,
            'message' => "Pekerjaan untuk request #{$this->serviceRequest->id} telah diselesaikan.",
            'url' => route('admin.orders.index'), // Link saat notifikasi di-klik
        ];
    }
}