public function getLeadsByClient($client_id) {
    return $this->where('client_id', $client_id)->findAll();
}
<!-- fetches all leads for client dynanically  -->