<?php

class User_Controller {

    public function login () {

        $template = new Template('user/login.php');

        if (isset($_POST['username']) && isset($_POST['password']) ) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $login_model = new Login_Model();
            try {
                $login_model->login($username, $password);

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
        $login_model->logout();

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
                $username = $_POST['username'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                $email = $_POST['email'];
                if ($password !== $confirm_password) {
                    throw new InvalidRegisterException("Password and confirm does not match");
                }

                $login_model = new Login_Model();
                $login_model->register($username,$password, $email);

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

}