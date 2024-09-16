<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LeadsModel;

class Clients extends BaseController
{
    public function all_leads($client_id = null)
    {
        if ($client_id === null) {
            return redirect()->to('/admin/clients/index')->with('error', 'Client ID is required.');
        }

        $leadsModel = new LeadsModel();

        $startDate = $this->request->getGet('start');
        $endDate = $this->request->getGet('end');

        if ($startDate && $endDate) {
            $leads = $leadsModel->where('client_id', $client_id)
                                ->where('created_at >=', $startDate)
                                ->where('created_at <=', $endDate)
                                ->findAll();
        } else {
            $leads = $leadsModel->where('client_id', $client_id)->findAll();
        }

        if ($this->request->isAJAX()) {
            return view('admin/clients/partial_leads', ['leads' => $leads]); 
        }

        return view('admin/clients/all_leads', ['leads' => $leads]);
    }
}
