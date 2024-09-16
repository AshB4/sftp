<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LeadsSeeder extends Seeder
{
    public function run()
    {
        // Data to be inserted
        $data = [
            [
                'client_id' => 'parrains',
                'type' => 'Chat',
                'lead_id' => '12345',
                'status' => 'Unique Lead',
                'sh_status' => 'Unique Lead',
                'source' => 'Google Ads',
                'medium' => 'CPC',
                'keyword' => 'example keyword',
                'lead_page' => '/contact',
                'duration' => 120,
                'recording_link' => '',
                'caller_phone' => '1234567890',
                'email_address' => 'test@example.com',
                'sentiment' => 'Positive',
                'customer_id' => 'cust_001'
            ],
            // Add more dummy data as needed
        ];

          // Generate dynamic dummy data
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'client_id' => 'client_' . $i,
                'type' => $this->randomType(),
                'lead_id' => 'lead_' . (1000 + $i),
                'status' => $this->randomLeadStatus(),
                'sh_status' => $this->randomLeadStatus(),
                'source' => $this->randomSource(),
                'medium' => $this->randomMedium(),
                'keyword' => 'keyword_' . $i,
                'lead_page' => '/page' . $i,
                'duration' => rand(30, 300),
                'recording_link' => '',
                'caller_phone' => '123456789' . $i,
                'email_address' => 'user' . $i . '@example.com',
                'sentiment' => $this->randomSentiment(),
                'customer_id' => 'cust_' . (100 + $i),
            ];
        }

        // Iterate over each lead data and check for duplicates before inserting
        foreach ($data as $lead) {
            
            $existingLead = $this->db->table('sh_leads')->where('lead_id', $lead['lead_id'])->get()->getRow();
            if ($existingLead) {
                log_message('info', 'Duplicate lead_id found: ' . $lead['lead_id'] . '. Skipping insertion.');
                continue; // Skip insertion if duplicate is found
            }

            
            $this->db->table('sh_leads')->insert($lead);
            log_message('info', 'Inserted lead_id: ' . $lead['lead_id']);
        }
    }
 // generate random data
    private function randomType()
    {
        $types = ['Chat', 'Call', 'Email'];
        return $types[array_rand($types)];
    }

    private function randomLeadStatus()
    {
        $leadStatuses = ['Unique Lead', 'Duplicate Lead', 'Pending', 'Closed'];
        return $leadStatuses[array_rand($leadStatuses)];
    }

    private function randomSource()
    {
        $sources = ['Google Ads', 'Facebook Ads', 'LinkedIn', 'Organic Search'];
        return $sources[array_rand($sources)];
    }

    private function randomMedium()
    {
        $mediums = ['CPC', 'Organic', 'Referral', 'Direct'];
        return $mediums[array_rand($mediums)];
    }

    private function randomSentiment()
    {
        $sentiments = ['Positive', 'Negative', 'Neutral'];
        return $sentiments[array_rand($sentiments)];
    }

// generate unique lead ID
    private function generateUniqueLeadId($prefix = 'lead_')
    {
        return $prefix . uniqid();
    }
}