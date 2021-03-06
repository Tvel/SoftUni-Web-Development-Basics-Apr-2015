<?php

class User_Controller {

    public function login () {

        $template = new Template('user/login.php');

        if (isset($_POST['username']) && isset($_POST['password']) ) {
            $username = Helper::SanatizeString($_POST['username']);
            $password = Helper::SanatizeString($_POST['password']);

            $login_model = new Login_Model();
            try {
                $login_model->Login($username, $password);

                header("Location: ".SITE_ROOT_URL."blog/index");
                die();
            }
            catch (InvalidLoginUsernameException $ex){
                $template->set('error', 'Invalid username');
            }
            catch (InvalidLoginPasswordException $ex){
                $template->set('error', 'Invalid password');
            }
        }

        $template->render();
    }

    public function logout () {
        $login_model = new Login_Model();
        $login_model->Logout();

        header("Location: ".SITE_ROOT_URL."blog/index");
        die();
    }

    public function register() {

        $template = new Template('user/register.php');
        $username = null;
        $password = null;
        $confirm_password = null;
        $email = null;


        if (isset($_POST['username']) ) {
            try {
                if (!isset($_POST['username'])) {
                    throw new InvalidRegisterException("Username cannot be empty");
                }
                if (!isset($_POST['password'])) {
                    throw new InvalidRegisterException("Password cannot be empty");
                }
                if (!isset($_POST['confirm_password'])) {
                    throw new InvalidRegisterException("Confirm Password cannot be empty");
                }
                if (!isset($_POST['email'])) {
                    throw new InvalidRegisterException("Email cannot be empty");
                }
                $username = Helper::SanatizeString($_POST['username']);
                $password = Helper::SanatizeString($_POST['password']);
                $confirm_password = Helper::SanatizeString($_POST['confirm_password']);
                $email = Helper::SanatizeString($_POST['email']);
                if ($password !== $confirm_password) {
                    throw new InvalidRegisterException("Password and confirm does not match");
                }

                $login_model = new Login_Model();
                $login_model->Register($username,$password, $email);

                header("Location: ".SITE_ROOT_URL."blog/index");
                die();
            }
            catch(InvalidRegisterException $ex) {
                $template->set('error', $ex->getMessage());
            }

        }
        $template->set('username', $username);
        $template->set('password', $password);
        $template->set('confirm_password', $confirm_password);
        $template->set('email', $email);

        $template->render();
    }

    public function myprofile() {
        $template = new Template('user/myprofile.php');
        $user_model = new User_Model();

        $user = $user_model->GetUser($_SESSION['userId']);

        $template->set('email', $user->email);
        $template->set('about', $user->about);

        if(isset($_POST['email'])) {
            $email = Helper::SanatizeString($_POST['email']);
            $about = $_POST['about'];


            $user_model->EditInfo($user->id, $email, $about);
            $template->set('success', "User profile updated");

        }

        if(isset($_POST['old-password'])) {
            $oldPassword = Helper::SanatizeString($_POST['old-password']);
            $newPassword = Helper::SanatizeString($_POST['new-password']);
            $confirmPassword = Helper::SanatizeString($_POST['confirm-password']);

            try {
                if ($newPassword !== $confirmPassword) {
                    throw new InvalidFormDataException("Passwords does not match");
                }

                $user_model->ChangePass($user->id, $oldPassword, $newPassword);
                $template->set('success', "Password changed");
            }
            catch( InvalidFormDataException $ex){
                $template->set('error', $ex->getMessage());
            }

        }
        $template->render();
    }

    public function profile(){
        $template = new Template('user/profile.php');
        $user_id = Parameters::get(0);
        $user_model = new User_Model();

        $user = $user_model->GetUser($user_id);

        $template->set('user', $user);
        $template->set('posts', $user->with('ORDER BY visits DESC LIMIT 5')->ownPosts);
        $template->set('comments', $user->with('ORDER BY date DESC LIMIT 5')->ownComments);

        $template->render();
    }

    public function myposts(){
        $template = new Template('user/myposts.php');
        $blog_model = new Blog_Model();
        if (!Auth_Check::Poster()) {
            throw new NotAuthenticatedException("You have no rights to view your posts");
        }
        $posts = $blog_model->GetUserPosts($_SESSION['userId']);

        $template->set('pageTitle', 'My Posts');

        $users_posts = array();
        foreach ($posts as $post) {
            array_push($users_posts,array(
                'id' => $post->id,
                'title' => $post->title,
                'date' => $post->date,
                'comments' => $post->countOwn('comments'),
            ) );
        }
        $users_posts = json_encode($users_posts);

        $template->set('posts', $users_posts);

        $template->render();
    }
}