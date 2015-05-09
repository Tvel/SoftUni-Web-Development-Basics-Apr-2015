<?php

class User_Model {

    public function GetUser($id){
        $user = R::findOne('users', 'id = ?', [ $id ]);
        if ($user === null) {
            throw new InvalidIdException("User does not exist");
        }
        return $user;
    }

    public function EditInfo($id, $email, $about){
        $user = $this->GetUser($id);

        $user->email = $email;
        $user->about = $about;
        $user->setMeta('cast.about', 'text');
        R::store($user);
        return $user;
    }

    public function ChangePass($id, $oldPassword, $newPassword){
        $user = $this->GetUser($id);
        if ($user->password !== $oldPassword){
            throw new InvalidFormDataException("Old password does not match");
        }

        $user->password = $newPassword;
        R::store($user);

        return $user;
    }

    public function AdminChangePass($id,  $newPassword){
        $user = $this->GetUser($id);
        $user->password = $newPassword;
        R::store($user);

        return $user;
    }
}