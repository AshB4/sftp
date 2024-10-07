namespace App\Controllers;

use App\Models\LeadsModel;
use CodeIgniter\RESTful\ResourceController;

class LeadsController extends ResourceController
{
    public function getLeads($client_id) {
        $model = new LeadsModel();
        $leads = $model->getLeadsByClient($client_id);

        if (empty($leads)) {
            return $this->failNotFound('No leads found for this client.');
        }

        return $this->respond($leads);
    }
}
<!-- API endpoint (/leads/getLeads/{client_id})  -->