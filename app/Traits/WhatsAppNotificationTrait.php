<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait WhatsAppNotificationTrait
{
    /**
     * Send WhatsApp notification to patient with credentials and clinic info
     */
    protected function sendPatientCredentialsWhatsApp($patient, $plainPassword): bool
    {
        try {
            $clinicName = auth()->user()->organization->name ?? 'Our Clinic';

            // Format phone number for WhatsApp chat ID format
            $chatId = $this->formatPhoneNumber($patient->phone);

            // Prepare the message
            $message = $this->buildPatientCredentialsMessage($patient, $plainPassword, $clinicName);

            // Send via Hypersender
            return $this->sendWhatsAppMessage($chatId, $message);

        } catch (\Exception $e) {
            Log::error("WhatsApp notification error for patient {$patient->email}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send appointment reminder WhatsApp notification
     */
    protected function sendAppointmentReminderWhatsApp($patient, $appointment): bool
    {
        try {
            $clinicName = auth()->user()->organization->name ?? 'Our Clinic';
            $chatId = $this->formatPhoneNumber($patient->phone);

            $message = $this->buildAppointmentReminderMessage($patient, $appointment, $clinicName);

            return $this->sendWhatsAppMessage($chatId, $message);

        } catch (\Exception $e) {
            Log::error("WhatsApp appointment reminder error for patient {$patient->email}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send custom WhatsApp notification
     */
    protected function sendCustomWhatsAppNotification($phone, $message)
    {
        try {
            $chatId = $this->formatPhoneNumber($phone);
            return $this->sendWhatsAppMessage($chatId, $message);

        } catch (\Exception $e) {
            Log::error("Custom WhatsApp notification error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send WhatsApp message using Hypersender API
     */
    private function sendWhatsAppMessage($chatId, $message)
    {
        $instance = config('whatsapp.hypersender.instance_id', '9f019bb4-dc27-4d6f-bb58-4e627e1cabfb');
        $token = config('whatsapp.hypersender.token', '240|6CASHwjIGSUGGHVDuPpZCZKfivVV8kixl7aIPOFc53b42a26');

        $url = "https://app.hypersender.com/api/whatsapp/v1/{$instance}/send-text";

        try {
            // Using Laravel HTTP client instead of cURL for better error handling
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])->timeout(30)->post($url, [
                'chatId' => $chatId,
                'text' => $message,
                'link_preview' => false
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully', [
                    'chat_id' => $chatId,
                    'response' => $response->json()
                ]);
                return true;
            } else {
                Log::error('Failed to send WhatsApp message', [
                    'http_code' => $response->status(),
                    'response' => $response->body(),
                    'chat_id' => $chatId
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Error sending WhatsApp message: ' . $e->getMessage(), [
                'chat_id' => $chatId
            ]);
            return false;
        }
    }

    /**
     * Build patient credentials message
     */
    private function buildPatientCredentialsMessage($patient, $plainPassword, $clinicName)
    {
        $message = "🏥 Welcome to {$clinicName}!\n\n";
        $message .= "Dear {$patient->name},\n\n";
        $message .= "Your account has been created successfully. Here are your login credentials:\n\n";
        $message .= "📧 Email: {$patient->email}\n";
        $message .= "🔐 Password: {$plainPassword}\n\n";
        $message .= "You can now access our patient portal to:\n";
        $message .= "• View your appointments\n";
        $message .= "• Access medical records\n";
        $message .= "• Communicate with our team\n\n";
        $message .= "Please keep your credentials secure and change your password after first login.\n\n";
        $message .= "If you have any questions, feel free to contact us.\n\n";
        $message .= "Best regards,\n{$clinicName} Team";

        return $message;
    }

    /**
     * Build appointment reminder message
     */
    private function buildAppointmentReminderMessage($patient, $appointment, $clinicName)
    {
        $appointmentDate = $appointment->appointment_date ?? 'TBD';
        $appointmentTime = $appointment->appointment_time ?? 'TBD';

        $message = "🏥 {$clinicName} - Appointment Reminder\n\n";
        $message .= "Dear {$patient->name},\n\n";
        $message .= "This is a reminder of your upcoming appointment:\n\n";
        $message .= "📅 Date: {$appointmentDate}\n";
        $message .= "🕐 Time: {$appointmentTime}\n";

        if (isset($appointment->doctor->name)) {
            $message .= "👨‍⚕️ Doctor: {$appointment->doctor->name}\n";
        }

        $message .= "\nPlease arrive 15 minutes early for check-in.\n\n";
        $message .= "If you need to reschedule, please contact us as soon as possible.\n\n";
        $message .= "Best regards,\n{$clinicName} Team";

        return $message;
    }

    /**
     * Format phone number for WhatsApp (ensure country code is present)
     */
    private function formatPhoneNumber($phone)
    {
        if (empty($phone)) {
            return null;
        }

        // Remove any spaces, dashes, or special characters
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        // If phone doesn't start with +, add your default country code
        // You can configure this in your config file
        if (!str_starts_with($phone, '+')) {
            $defaultCountryCode = config('whatsapp.default_country_code', '+20'); // Egypt by default
            $phone = $defaultCountryCode . ltrim($phone, '0');
        }

        // Remove + for chat ID format (Hypersender expects without +)
        return ltrim($phone, '+');
    }

    /**
     * Check if WhatsApp notifications are enabled
     */
    protected function isWhatsAppEnabled()
    {
        return config('whatsapp.enabled', true);
    }
}
