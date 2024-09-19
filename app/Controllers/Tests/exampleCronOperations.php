<?php

// namespace App\Controllers\Tests; 

// use App\Controllers\BaseController; 
// use App\Models\CronStatusModel; 

// class ExampleCronOperations extends BaseController 
// {
//     public function exampleCronOperations()
//     {
//         ob_start(); 
//         echo "Starting exampleCronOperations...<br>";

//         try {
//             $cronModel = new CronStatusModel();

//             // Check if headers are already sent
//             if (headers_sent($file, $line)) {
//                 echo "Headers already sent in $file on line $line<br>";
//             } else {
//                 echo "Headers not sent yet.<br>";
//             }

//             // Checkpoint before creating cron status
//             echo "Checkpoint 1: Before creating cron status.<br>";

//             // Create a new cron status entry
//             $newId = $cronModel->createCronStatus([
//                 'Type' => 'Lead Import',
//                 'Last_Ran' => date('Y-m-d H:i:s'),
//                 'Status' => 'Completed',
//                 'Message' => 'Successfully imported leads.'
//             ]);

//             echo "Created new cron status with ID: $newId<br>";

//             // Checkpoint after creating cron status
//             echo "Checkpoint 2: After creating cron status.<br>";

//             // Read a specific cron status by ID
//             $status = $cronModel->getCronStatusById($newId);
//             echo "Read cron status: " . json_encode($status) . "<br>";

//             // Read all cron statuses
//             $allStatuses = $cronModel->getAllCronStatuses();
//             echo "All cron statuses: " . json_encode($allStatuses) . "<br>";

//             // Update a cron status entry
//             $updated = $cronModel->updateCronStatus($newId, ['Status' => 'Failed', 'Message' => 'API error occurred.']);
//             echo "Updated cron status: " . ($updated ? 'Success' : 'Failure') . "<br>";

//             // Delete a cron status entry
//             $deleted = $cronModel->deleteCronStatus($newId);
//             echo "Deleted cron status: " . ($deleted ? 'Success' : 'Failure') . "<br>";

//         } catch (\Exception $e) {
//             echo 'An error occurred: ' . $e->getMessage();
//         }

//         ob_end_flush(); 
//     }
// }
