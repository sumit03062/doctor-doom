<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;

class GoogleController extends Controller
{
    // Redirect user to Google auth page
    public function auth()
    {
        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setScopes(GoogleCalendar::CALENDAR);
        $client->setRedirectUri(url('/google/callback'));

        return redirect($client->createAuthUrl());
    }

    // Handle Google callback and save token
    public function callback(Request $request)
    {
        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setScopes(GoogleCalendar::CALENDAR);
        $client->setRedirectUri(url('/google/callback'));

        if (!$request->has('code')) {
            return redirect('/')->with('error', 'Authorization code not provided!');
        }

        $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));

        // Save token
        file_put_contents(storage_path('app/google/token.json'), json_encode($token));

        return redirect('/')->with('success', 'Google Calendar connected successfully!');
    }
}
