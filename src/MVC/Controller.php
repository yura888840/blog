<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:13
 */

namespace Blog\MVC;

/**
 * Class Controller
 * @package Blog\MVC
 */
class Controller
{
    protected $requestMethod;
    protected $requestData;
    protected $dbh;

    /**
     * Controller constructor.
     * @param string $requestMethod
     * @param array $requestData
     * @param $dbh
     */
    public function __construct($requestMethod = 'GET', $requestData = [], $dbh)
    {
        $this->requestMethod = $requestMethod;
        $this->requestData = $requestData;
        $this->dbh = $dbh;
    }
    /**
     * @param $template
     * @param array $params
     * @return string
     */
    public function render($template, $params = [])
    {
        $view = new View();

        return $view->render($template, $params);
    }

    /**
     * @param string $route
     */
    public function redirect302($route = '/')
    {
        header('Location: ' . $route);
    }
}
