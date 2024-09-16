<?php

namespace App\Models;

use CodeIgniter\Model;

class CronStatusModel extends Model
{
    protected $table = 'sh_cron_statuses';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['Type', 'Last_Ran', 'Status', 'Message'];

    /**
     * Create a new cron status entry
     *
     * @param array $data
     * @return bool|int
     */
    public function createCronStatus(array $data)
    {
        return $this->insert($data); 
    }

    /**
     * Read cron status by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getCronStatusById(int $id)
    {
        return $this->find($id); 
    }

    /**
     * Read all cron statuses
     *
     * @return array
     */
    public function getAllCronStatuses()
    {
        return $this->findAll(); 
    }

    /**
     * Update a cron status entry
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCronStatus(int $id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete a cron status entry
     *
     * @param int $id
     * @return bool
     */
    public function deleteCronStatus(int $id)
    {
        return $this->delete($id); 
    }
}
