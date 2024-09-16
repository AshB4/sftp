<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;  

class Users extends BaseController
{
    private $model;
    private $dummyUsers;

    public function __construct()
    {
      
        if (ENVIRONMENT === 'development' || !$this->hasDatabaseAccess()) {
          
            $this->dummyUsers = [
                1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'is_active' => 1],
                2 => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'is_active' => 0],
                3 => ['id' => 3, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'is_active' => 1],
            ];
        } else {
         
            $this->model = new UserModel();
        }
    }

    private function hasDatabaseAccess()
    {
        // Here you can check if you have credentials or a way to connect to the database.
        // For simplicity, we are assuming you check for a specific configuration or environment variable.
        return getenv('DB_HOST') && getenv('DB_USER') && getenv('DB_PASS');
    }

    public function index()
    {
        if (isset($this->dummyUsers)) {
          
            return view('admin/users/index', ['users' => $this->dummyUsers]);
        } else {
          
            $users = $this->model->findAll();
            return view('admin/users/index', ['users' => $users]);
        }
    }

    public function toggle_user_is_active($id)
    {
        if (isset($this->dummyUsers)) {
         
            if (!isset($this->dummyUsers[$id])) {
              
                return redirect()->to('/admin/users/index')
                                 ->with('error', 'User not found');
            }

            $this->dummyUsers[$id]['is_active'] = ($this->dummyUsers[$id]['is_active'] == 1) ? 0 : 1;

           
            $updatedUser = $this->dummyUsers[$id];

            return redirect()->to('/admin/users/index')
                             ->with('info', 'Success - User status updated for ' . $updatedUser['name']);
        } else {
        
            $user = $this->model->find($id);

            if (!$user) {
                return redirect()->to('/admin/users/index')
                                 ->with('error', 'User not found');
            }

            $user['is_active'] = ($user['is_active'] == 1) ? 0 : 1;
            $this->model->save($user);

            return redirect()->to('/admin/users/index')
                             ->with('info', 'Success - User status updated');
        }
    }
}
