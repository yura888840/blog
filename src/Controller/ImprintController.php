<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:17
 */

namespace Blog\Controller;

use Blog\MVC\Controller;

class ImprintController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/imprint',array_merge($_SESSION, []));
    }
}
