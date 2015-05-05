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
                //TODO: redirect to home
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

    }

}