<?php
namespace App\Helpers;

class WhatConvertsHelper
{
    private $apiUrl = "https://app.whatconverts.com/api/v1/";

    public function fetchLeads($wcApiKey)
    {
        // Comment out the actual API call logic
        /*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . "leads");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $wcApiKey,
            "Content-Type: application/json"
        ]);
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($result === false) {
            log_message('error', 'cURL Error: ' . curl_error($ch));
            curl_close($ch); // Close cURL session before returning
            return ['error' => curl_error($ch)];
        }

        curl_close($ch); // Close cURL session

        log_message('info', 'WhatConverts API Response: ' . $result);
        log_message('info', 'HTTP Status Code: ' . $http_code);

        return json_decode($result, true);
        */

        // Mocked API response for local testing
        $mockResponse = [
            [
                'client_id' => 'parrains',
                'type' => 'Phone Call',
                'lead_id' => 12345,
                'status' => 'Unique Lead',
                'sh_status' => 'Unique Lead',
                'source' => 'Google Ads',
                'medium' => 'CPC',
                'keyword' => 'Air Conditioning Repair',
                'lead_page' => '/services/ac-repair',
                'duration' => 120,
                'recording_link' => 'http://example.com/recording.mp3',
                'caller_phone' => '+1234567890',
                'email_address' => 'lead@example.com',
                'sentiment' => 'Positive',
                'customer_id' => 'cust_001'
            ]
        ];

        // Log the mock response for debugging
        log_message('info', 'Mock API Response: ' . json_encode($mockResponse));

        return $mockResponse; // Return mock data instead of making an actual API call
    }
}
