<?php

class User_Model {

    public function GetRoles(){
        $roles = R::enum( 'role' );
        return $roles;
    }

    public function EditRole($userId, $roleName){
        $user = $this->GetUser($userId);
        if (!Auth_Check::OnlyAdmin()) {
            throw new NotAuthenticatedException("You have no rights to edit this user");
        }
        $user->role = R::enum('role:'.$roleName);
        R::store($user);
        return $user;
    }

    public function GetUser($id){
        $user = R::findOne('users', 'id = ?', [ $id ]);
        if ($user === null) {
            throw new InvalidIdException("User does not exist");
        }

        return $user;
    }

    public function EditInfo($id, $email, $about){
        $user = $this->GetUser($id);
        if (!Auth_Check::CheckIfCanEditUser($user)) {
            throw new NotAuthenticatedException("You have no rights to edit this user");
        }

        $user->email = $email;
        $user->about = $about;
        $user->setMeta('cast.about', 'text');
        R::store($user);
        return $user;
    }

    public function ChangePass($id, $oldPassword, $newPassword){
        $user = $this->GetUser($id);
        if (!Auth_Check::CheckIfCanEditUser($user)) {
            throw new NotAuthenticatedException("You have no rights to edit this user");
        }
        if ($user->password !== $oldPassword){
            throw new InvalidFormDataException("Old password does not match");
        }

        $user->password = $newPassword;
        R::store($user);

        return $user;
    }

    public function AdminChangePass($id,  $newPassword){
        if (!Auth_Check::OnlyAdmin()) {
            throw new NotAuthenticatedException("You have no rights to edit this user");
        }

        $user = $this->GetUser($id);
        $user->password = $newPassword;
        R::store($user);

        return $user;
    }

    public function AdminEditInfo($id, $email, $about, $username){
        if (!Auth_Check::OnlyAdmin()) {
            throw new NotAuthenticatedException("You have no rights to edit this user");
        }
        $user = $this->EditInfo($id, $email, $about);
        $user->username = $username;

        R::store($user);
        return $user;
    }

    public function GetUsers(){
        if (!Auth_Check::OnlyAdmin()) {
            throw new NotAuthenticatedException("You have no rights to view all users");
        }

        $users = R::findAll('users');
        return $users;
    }


}