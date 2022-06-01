<?php

namespace App\Controllers;

use App\Config;
use App\Model\UserRegister;
use App\Models\Messages;
use App\Models\Articles;
// use App\Models\User;
use App\Utility\Hash;
use App\Utility\Session;
use \Core\View;
use Exception;
use http\Env\Request;
use http\Exception\InvalidArgumentException;

/**
 * User controller
 */
class User extends \Core\Controller
{

    /**
     * Affiche la page de login
     */
    public function loginAction()
    {

        if(isset($_POST['submit'])){

            // TODO: Validation

            // if(isset($_COOKIE)){
            //     $f = $_COOKIE;
            // }else{
            //     $f = $_POST;
            // }
            $f = $_POST;
            $c = $_COOKIE;

            foreach ($f as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $f[$key] = htmlspecialchars($value);
            }

            $this->login($c);

            $this->login($f);
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];


            // Si login OK, redirige vers le compte
            header('Location: /account');
        }

        View::renderTemplate('User/login.html');
    }

    /**
     * Page de création de compte
     */
    public function registerAction()
    {
        if(isset($_POST['submit'])){
            foreach ($_POST as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $_POST[$key] = htmlspecialchars($value);
            }
            
            $f = $_POST;

            if($f['password'] !== $f['password-check']){
                // TODO: Gestion d'erreur côté utilisateur
            }else{
                $this->register($f);

                $this->login($f);
    
                // Si login OK, redirige vers le compte
                header('Location: /account');
            }

        }

        View::renderTemplate('User/register.html');
    }

    /**
     * Affiche la page du compte
     */
    public function accountAction()
    {   
        $data['id'] = $_SESSION['user']['id'];
        $articles = Articles::getByUser($_SESSION['user']['id']);
        $messages = Messages::getByUser($data);


        View::renderTemplate('User/account.html', [
            'articles' => $articles,
            'messages' => $messages
        ]);
    }

    public function editAction(){
        $data['id'] = $_SESSION['user']['id'];


        if(isset($_POST['submit'])){
            foreach ($_POST as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $_POST[$key] = htmlspecialchars($value);
            }
            
            $f = $_POST;
            if($this->login($f)){
                $this->edit($f, $data['id']);
            }else{
                header('Location: /login');

            }

            // Si login OK, redirige vers le compte
            // TODO: Rappeler la fonction de login pour connecter l'utilisateur
        }
        $user = \App\Models\User::getById($_SESSION['user']['id']);

        View::renderTemplate('User/edit.html', [
            'username' => $user['username'],
            'email' => $user['email'],
        ]);

    }

    /*
     * Fonction privée pour enregister un utilisateur
     */
    private function register($data)
    {
        try {

            foreach ($_POST as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $_POST[$key] = htmlspecialchars($value);
            }

            // Generate a salt, which will be applied to the during the password
            // hashing process.
            $salt = Hash::generateSalt(32);

            $userID = \App\Models\User::createUser([
                "email" => $data['email'],
                "username" => $data['username'],
                "password" => Hash::generate($data['password'], $salt),
                "salt" => $salt
            ]);

            return $userID;

        } catch (Exception $ex) {
            // TODO : Set flash if error : utiliser la fonction en dessous
            /* Utility\Flash::danger($ex->getMessage());*/
        }
    }


    private function edit($data, $id)
    {
        try {

            foreach ($_POST as $key => $value) {
                $value = trim($value);
                $value = stripslashes($value);
                $_POST[$key] = htmlspecialchars($value);
            }

            // Generate a salt, which will be applied to the during the password
            // hashing process.
            $salt = Hash::generateSalt(32);
            $userID = \App\Models\User::editUser([
                "id" => $id,
                "email" => $data['email'],
                "username" => $data['username'],
            ]);

            return $userID;

        } catch (Exception $ex) {
            // TODO : Set flash if error : utiliser la fonction en dessous
            /* Utility\Flash::danger($ex->getMessage());*/
        }
    }

    private function login($data){
        try {
            if(!isset($data['email'])){
                throw new Exception('TODO');
            }

            $user = \App\Models\User::getByLogin($data['email']);
            
            if (Hash::generate($data['password'], $user['salt']) !== $user['password']) {
                return false;
            }

            // TODO: Create a remember me cookie if the user has selected the option
            // to remained logged in on the login form.
            // https://github.com/andrewdyer/php-mvc-register-login/blob/development/www/app/Model/UserLogin.php#L86

            $_SESSION['user'] = array(
                'id' => $user['id'],
                'username' => $user['username'],
            );

            if($_POST['#'] == "on"){
                setcookie('email',$_POST['email'],time()+365*24*3600,null,null,false,true);
                setcookie('password',$_POST['password'],time()+365*24*3600,null,null,false,true);
            }

            return true;

        } catch (Exception $ex) {
            // TODO : Set flash if error
            /* Utility\Flash::danger($ex->getMessage());*/
        }
    }


    /**
     * Logout: Delete cookie and session. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public function logoutAction() {

        /*
        if (isset($_COOKIE[$cookie])){
            // TODO: Delete the users remember me cookie if one has been stored.
            // https://github.com/andrewdyer/php-mvc-register-login/blob/development/www/app/Model/UserLogin.php#L148
        }*/
        // Destroy all data registered to the session.

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        header ("Location: /");

        return true;
    }


}
