<?php

namespace App\Http\Traits;

use App\Models\Settings;
use Illuminate\Support\Env;
use MacsiDigital\Zoom\Facades\Zoom;
use MacsiDigital\Zoom\Setting;

trait ZoomMeetingTrait
{
    public function createMeetings($request)
    {
        // Retrieve Zoom API credentials from your settings
        $collection = Settings::all();
        $settings = $collection->pluck('value', 'key')->toArray();

        // Check if the keys exist before accessing them
        if (isset($settings['zoom_api_key']) && isset($settings['zoom_api_secret'])) {
            // Get the API key and secret from settings, or fallback to env variables
            $apiKey = $settings['zoom_api_key'] ?: env('ZOOM_CLIENT_KEY');
            $apiSecret = $settings['zoom_api_secret'] ?: env('ZOOM_CLIENT_SECRET');

            // Initialize the Zoom facade with your API credentials
            $zoom = new \MacsiDigital\Zoom\Support\Entry($apiKey, $apiSecret);

            // Get the user associated with your Zoom account
            $user = new \MacsiDigital\Zoom\User($zoom);

            // Define meeting data
            $meetingData = [
                'topic' => $request->topic,
                'type' => 2, // Scheduled meeting
                'duration' => $request->duration,
                'password' => $request->password,
                'start_time' => $request->start_time,
                'timezone' => config('zoom.timezone')
                // 'timezone' => 'Africa/Cairo'
            ];

            // Create a new meeting
            $meeting = $user->meetings()->make($meetingData);

            // Define meeting settings
            // $meeting->settings = [
            //     'join_before_host' => false,
            //     'host_video' => false,
            //     'participant_video' => false,
            //     'mute_upon_entry' => true,
            //     'waiting_room' => true,
            //     'approval_type' => config('zoom.approval_type'),
            //     'audio' => config('zoom.audio'),
            //     'auto_recording' => config('zoom.auto_recording')
            // ];

            dd($meeting);
            // Save the meeting
            $meeting->save();

            // Return the meeting or handle success as needed
            return $meeting;
        } else {
            // Handle the case where the keys are not found in $settings
            // You can log an error or return an error response
            // For example:
            return response()->json(['error' => 'Zoom API credentials not found in settings.'], 500);
        }
    }


    public function createMeeting($request)
    {

        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            'timezone' => config('zoom.timezone')
          // 'timezone' => 'Africa/Cairo'
        ];

        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);

        return  $user->meetings()->save($meeting);


    }
}
