public function testCronStatusModel()
{
    echo "Testing Cron Status Model...\n"; 

    $cronModel = new \App\Models\CronStatusModel();


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
