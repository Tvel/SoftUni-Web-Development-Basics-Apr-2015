<?php

class Users_AdminController {

    public function index (){
        $this->users();
    }

    public function users (){
        if (!Auth_Check::OnlyAdmin()) {
            throw new NotAuthenticatedException("You have no rights to view all users");
        }
        $template = new Template('admin/users/users.php');
        $template->set_header('admin/header.php');
        $template->set('pageTitle', 'All Users');

        $user_model = new User_Model();

        $users = $user_model->GetUsers();

        $users_json = array();
        foreach ($users as $user) {
            array_push($users_json,array(
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role->name,
            ) );
        }
        $users_json = json_encode($users_json);

        $template->set('users', $users_json);

        $template->render();
    }

    public function edituser(){
        $user_model = new User_Model();
        $user = $user_model->GetUser(Parameters::get(0));

        if(!Auth_Check::OnlyAdmin()){
            throw new NotAuthenticatedException("You don't have the rights to edit this user");
        }

        $template = new Template('admin/users/edituser.php');
        $template->set_header('admin/header.php');


        if(isset($_POST['email'])) {
            $email = Helper::SanatizeString($_POST['email']);
            $username = Helper::SanatizeString($_POST['username']);
            $about = $_POST['about'];

            try {
                $user = $user_model->AdminEditInfo($user->id, $email, $about, $username);
                $template->set('success', "User profile updated");
            }
            catch( Exception $ex){
                $template->set('error', $ex->getMessage());
            }
        }

        if(isset($_POST['role'])) {
            $role = Helper::SanatizeString($_POST['role']);

            try {
                $user = $user_model->EditRole($user->id, $role);
                $template->set('success', "User Role updated");
            }
            catch( Exception $ex){
                $template->set('error', $ex->getMessage());
            }
        }

        if(isset($_POST['new-password'])) {
            $newPassword = Helper::SanatizeString($_POST['new-password']);
            $confirmPassword = Helper::SanatizeString($_POST['confirm-password']);

            try {
                if ($newPassword !== $confirmPassword) {
                    throw new InvalidFormDataException("Passwords does not match");
                }
                $user = $user_model->AdminChangePass($user->id, $newPassword);
                $template->set('success', "Password changed");
            }
            catch( InvalidFormDataException $ex){
                $template->set('error', $ex->getMessage());
            }

        }

        $template->set('title', 'Admin Edit User');
        $template->set('username', $user->username);
        $template->set('about', $user->about);
        $template->set('email', $user->email);
        $template->set('role', $user->role);
        $template->set('roles', $user_model->GetRoles());
        $template->render();
    }
}