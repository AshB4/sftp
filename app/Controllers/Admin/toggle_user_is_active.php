<?php

// namespace App\Controllers\Admin;

// use App\Controllers\BaseController;
// use App\Models\UserModel;

// class Users extends BaseController
// {
//     private $model;

//     public function __construct()
//     {
//         $this->model = new UserModel();
//     }

//     public function toggle_user_is_active($id)
//     {
//         $user = $this->model->find($id);

//         if (!$user) {
//             return redirect()->to('/Admin/Users/index')
//                              ->with('error', 'User not found');
//         }

//         $user['is_active'] = ($user['is_active'] == 1) ? 0 : 1;
//         $this->model->save($user);

//         return redirect()->to('/Admin/Users/index')
//                          ->with('info', 'Success - User status updated');
//     }

// }
