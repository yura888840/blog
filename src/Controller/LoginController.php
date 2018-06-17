<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:12
 */

namespace Blog\Controller;

use Blog\Model\User;
use Blog\MVC\Controller;

class LoginController extends Controller
{

    public function loginAction()
    {
        $msg = '';

        if ($this->requestMethod == "POST") {
            $result = User::findByNameAndPass(
                $this->dbh,
                $this->requestData['login'],
                $this->requestData['password']
            );

            if ($result) {
                $_SESSION['user'] = $this->requestData['login'];

                return $this->redirect302('/');
            } else {
                $msg = 'Incorrect login /password';
            }

        }

        return $this->render('default/login', array_merge($_SESSION, ['msg' => $msg]));
    }

    public function logoutAction()
    {
        unset($_SESSION['user']);

        return $this->redirect302('/');
    }
}
