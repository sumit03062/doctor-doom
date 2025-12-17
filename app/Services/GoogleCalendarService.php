<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class GoogleCalendarService
{
    protected function getClient()
    {
        $client = new Client();
        $client->setApplicationName('Appointment Booking');
        $client->setScopes(Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');

        // Load saved token
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $client->setAccessToken(json_decode(file_get_contents($tokenPath), true));
        }

        // Refresh token if expired
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        return $client;
    }

    public function createEvent($data)
    {
        $client = $this->getClient();
        $service = new Calendar($client);

        $event = new Event([
            'summary' => 'Doctor Appointment - ' . $data['full_name'],
            'description' => $data['message'] ?? 'No additional notes',
            'start' => [
                'dateTime' => $data['start'],
                'timeZone' => 'Asia/Kolkata',
            ],
            'end' => [
                'dateTime' => $data['end'],
                'timeZone' => 'Asia/Kolkata',
            ],
        ]);

        return $service->events->insert(
            env('GOOGLE_CALENDAR_ID'),
            $event
        );
    }
}
