<?php

namespace App\Controllers;

use App\Models\LeadsModel;
use App\Models\CronStatusModel;
use App\Helpers\WhatConvertsHelper;
use CodeIgniter\Controller;

class WhatConvertsIntegration extends Controller
{
    public function fetchLeads()
    {
        $helper = new WhatConvertsHelper();
        $model = new LeadsModel();
        $cronModel = new CronStatusModel(); 

        if (ENVIRONMENT === 'development') {
            $dummyLeadsData = [
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
                ],
                [
                    'client_id' => 'parrains',
                    'type' => 'Email',
                    'lead_id' => 12346,
                    'status' => 'Repeat Lead',
                    'sh_status' => 'Repeat Lead',
                    'source' => 'Organic Search',
                    'medium' => 'SEO',
                    'keyword' => 'Furnace Repair',
                    'lead_page' => '/services/furnace-repair',
                    'duration' => 0,
                    'recording_link' => '',
                    'caller_phone' => '',
                    'email_address' => 'repeatlead@example.com',
                    'sentiment' => 'Neutral',
                    'customer_id' => 'cust_002'
                ],
            ];

            $leadsData = $dummyLeadsData;
        } else {
            $wcApiKey = getenv('WC_API_KEY_PARRAINS'); 
            try {
                $leadsData = $helper->fetchLeads($wcApiKey);
            } catch (\Exception $e) {
                return $this->respondWithError('Failed to fetch leads from WhatConverts: ' . $e->getMessage(), 500);
            }
        }

        if (isset($leadsData['error']) || empty($leadsData)) {
            $status = 'Failed';
            $message = isset($leadsData['error']) ? $leadsData['error'] : 'No leads data available.';
            $httpStatusCode = isset($leadsData['error_code']) ? $leadsData['error_code'] : 404;
        } else {
            $status = 'Success';
            $message = 'Leads data fetched successfully.';
            
            try {
                $model->storeLeads($leadsData);
            } catch (\Exception $e) {
                return $this->respondWithError('Failed to store leads data: ' . $e->getMessage(), 500);
            }
        }

        $cronData = [
            'Type' => 'fetchLeads',
            'Last_Ran' => date('Y-m-d H:i:s'),
            'Status' => $status,
            'Message' => $message
        ];

        if (empty($cronData)) {
            log_message('error', 'Cron data is empty.');
        } else {
            log_message('debug', 'Cron data before save: ' . json_encode($cronData));
            try {
                $cronModel->save($cronData);
                log_message('info', 'Cron status saved successfully.');
            } catch (\Exception $e) {
                log_message('error', 'Failed to save cron status: ' . $e->getMessage());
            }
        }

        return $this->response->setJSON([
            'status' => $status,
            'message' => $message
        ])->setStatusCode($status === 'Success' ? 200 : $httpStatusCode);
    }

    private function respondWithError($message, $statusCode)
    {
        log_message('error', $message);
        return $this->response->setJSON(['status' => 'Failed', 'message' => $message])->setStatusCode($statusCode);
    }

    public function exampleCronOperations()
    {
        $cronModel = new CronStatusModel();

        
        $cronModel->createCronStatus([
            'Type' => 'Lead Import',
            'Last_Ran' => date('Y-m-d H:i:s'),
            'Status' => 'Completed',
            'Message' => 'Successfully imported leads.'
        ]);

        $status = $cronModel->getCronStatusById(1);

 
        $allStatuses = $cronModel->getAllCronStatuses();


        $cronModel->updateCronStatus(1, ['Status' => 'Failed', 'Message' => 'API error occurred.']);


        $cronModel->deleteCronStatus(1);
    }

    public function testCronStatusModel()
    {
        echo "Testing Cron Status Model...\n"; 

        $cronModel = new CronStatusModel();

        $newId = $cronModel->createCronStatus([
            'Type' => 'Lead Import',
            'Last_Ran' => date('Y-m-d H:i:s'),
            'Status' => 'Completed',
            'Message' => 'Successfully imported leads.'
        ]);

        if ($newId) {
            echo "Created new cron status with ID: $newId\n";
        } else {
            echo "Failed to create new cron status.\n";
        }

        $status = $cronModel->getCronStatusById($newId);
        echo "Read cron status: " . json_encode($status) . "\n";

        $allStatuses = $cronModel->getAllCronStatuses();
        echo "All cron statuses: " . json_encode($allStatuses) . "\n";

        $updated = $cronModel->updateCronStatus($newId, ['Status' => 'Failed', 'Message' => 'API error occurred.']);
        echo "Updated cron status: " . ($updated ? 'Success' : 'Failure') . "\n";

        $deleted = $cronModel->deleteCronStatus($newId);
        echo "Deleted cron status: " . ($deleted ? 'Success' : 'Failure') . "\n";
    }
}
