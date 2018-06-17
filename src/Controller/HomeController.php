<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:14
 */

namespace Blog\Controller;

use Blog\MVC\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/homepage', array_merge($_SESSION, []));
    }
}
