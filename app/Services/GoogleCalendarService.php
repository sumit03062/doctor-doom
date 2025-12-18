<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Google\Service\Calendar\Event as GoogleEvent;

class GoogleCalendarService
{
    protected function getClient(): GoogleClient
    {
        $client = new GoogleClient();

        $client->setApplicationName('Appointment Booking');
        $client->setScopes(GoogleCalendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = storage_path('app/google/token.json');

        if (file_exists($tokenPath)) {
            $client->setAccessToken(
                json_decode(file_get_contents($tokenPath), true)
            );
        }

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken(
                    $client->getRefreshToken()
                );
                file_put_contents(
                    $tokenPath,
                    json_encode($client->getAccessToken())
                );
            }
        }

        return $client;
    }

    public function createEvent(array $data)
    {
        $service = new GoogleCalendar($this->getClient());

        $event = new GoogleEvent([
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
