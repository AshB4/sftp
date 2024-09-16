<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadsModel extends Model
{
    protected $table = 'sh_leads';
    protected $primaryKey = 'lead_id';
    protected $allowedFields = [
        'client_id', 'type', 'lead_id', 'status', 'sh_status', 'source',
        'medium', 'keyword', 'lead_page', 'duration', 'recording_link',
        'caller_phone', 'email_address', 'sentiment', 'customer_id'
    ];

    public function storeLeads($leadsData) 
    {
        
        if (!is_array($leadsData)) {
            log_message('error', 'Invalid leads data: ' . json_encode($leadsData));
            return;
        }

        foreach ($leadsData as $lead) {
            if (empty($lead)) {
                log_message('error', 'Empty lead data found.');
                continue; 
            }

            if (!isset($lead['lead_id']) || !isset($lead['type'])) {
                log_message('error', 'Missing required lead fields: ' . json_encode($lead));
                continue; 
            }

            
            $existingLead = $this->where('lead_id', $lead['lead_id'])->first();

            if ($existingLead) {
              
                try {
                    $this->update($existingLead['id'], [
                        'client_id' => $lead['client_id'] ?? $existingLead['client_id'],
                        'type' => $lead['type'],
                        'status' => $lead['status'] ?? $existingLead['status'],
                        'sh_status' => $lead['sh_status'] ?? $existingLead['sh_status'],
                        'source' => $lead['source'] ?? $existingLead['source'],
                        'medium' => $lead['medium'] ?? $existingLead['medium'],
                        'keyword' => $lead['keyword'] ?? $existingLead['keyword'],
                        'lead_page' => $lead['lead_page'] ?? $existingLead['lead_page'],
                        'duration' => $lead['duration'] ?? $existingLead['duration'],
                        'recording_link' => $lead['recording_link'] ?? $existingLead['recording_link'],
                        'caller_phone' => $lead['caller_phone'] ?? $existingLead['caller_phone'],
                        'email_address' => $lead['email_address'] ?? $existingLead['email_address'],
                        'sentiment' => $lead['sentiment'] ?? $existingLead['sentiment'],
                        'customer_id' => $lead['customer_id'] ?? $existingLead['customer_id']
                    ]);
                    log_message('info', 'Updated existing lead with ID: ' . $lead['lead_id']);
                } catch (\Exception $e) {
                    log_message('error', 'Failed to update lead with ID: ' . $lead['lead_id'] . '. Error: ' . $e->getMessage());
                }
            } else {
                // Insert the new lead
                try {
                    $this->insert([
                        'client_id' => $lead['client_id'] ?? null,
                        'type' => $lead['type'],
                        'lead_id' => $lead['lead_id'],
                        'status' => $lead['status'] ?? null,
                        'sh_status' => $lead['sh_status'] ?? null,
                        'source' => $lead['source'] ?? null,
                        'medium' => $lead['medium'] ?? null,
                        'keyword' => $lead['keyword'] ?? null,
                        'lead_page' => $lead['lead_page'] ?? null,
                        'duration' => $lead['duration'] ?? null,
                        'recording_link' => $lead['recording_link'] ?? null,
                        'caller_phone' => $lead['caller_phone'] ?? null,
                        'email_address' => $lead['email_address'] ?? null,
                        'sentiment' => $lead['sentiment'] ?? null,
                        'customer_id' => $lead['customer_id'] ?? null
                    ]);
                    log_message('info', 'Inserted new lead with ID: ' . $lead['lead_id']);
                } catch (\Exception $e) {
                    log_message('error', 'Failed to insert lead with ID: ' . $lead['lead_id'] . '. Error: ' . $e->getMessage());
                }
            }
        }
    }
}
