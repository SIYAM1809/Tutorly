<?php

namespace App\Channels;

use App\Models\WhatsappLog;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WhatsAppChannel
{
    /**
     * Send the given notification via WhatsApp.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toWhatsApp')) {
            return;
        }

        $message = $notification->toWhatsApp($notifiable);
        $phone = $notifiable->guardian_phone ?? $notifiable->phone;

        if (!$phone) {
            return;
        }

        $apiUrl = config('services.whatsapp.api_url');
        $token = config('services.whatsapp.token');

        $status = 'sent';

        if ($apiUrl && $token) {
            try {
                Http::withToken($token)->post($apiUrl, [
                    'recipient' => $phone,
                    'message' => $message['content'] ?? '',
                ]);
            } catch (\Exception $e) {
                Log::error("WhatsApp Channel dispatch failed: " . $e->getMessage());
                $status = 'failed';
            }
        }

        WhatsappLog::create([
            'user_id' => $notifiable->id ?? null,
            'recipient_phone' => $phone,
            'message_type' => $message['type'] ?? 'general_alert',
            'content' => $message['content'] ?? '',
            'status' => $status,
            'sent_at' => Carbon::now(),
        ]);
    }
}
