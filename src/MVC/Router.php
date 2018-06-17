<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:11
 */

namespace Blog\MVC;

class Router
{
    /**
     * @param $url
     * @param string $requestMethod
     * @param array $requestData
     * @return string
     */
    public function doRouting($url, $requestMethod = 'GET', $requestData = [])
    {
        $whatToExecute = $this->prepareForExecution($url);

        if (!is_array($whatToExecute)) {
            return 'Page Not found.';
        }

        $controllerName = sprintf('Blog\Controller\%sController', ucfirst($whatToExecute['controller']));
        $actionMethodName = sprintf('%sAction', $whatToExecute['action']);


        $config = require __DIR__ . '/../../Resources/config/config.php';
        $dbParams = $config['db'];

        try {
            $connStr = sprintf('mysql:host=%s;dbname=%s', $dbParams['host'], $dbParams['database']);
            $dbh = new \PDO($connStr, $dbParams['username'], $dbParams['password'], array(
                \PDO::ATTR_PERSISTENT => true
            ));
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        $controller = new $controllerName($requestMethod, array_merge($requestData,$whatToExecute['params']), $dbh);
        $viewData = $controller->$actionMethodName();

        return $viewData;
    }

    /**
     * @param $url
     * @return array|bool
     */
    private function prepareForExecution($url)
    {
        list($preparedUrl, $params) = $this->prepareUrl($url);

        /** @var array $routingTable */
        $routingTable = require_once __DIR__ . '/../../Resources/config/routing.php';

        if (!array_key_exists($preparedUrl, $routingTable)) {
            return false;
        }

        $routingData = $routingTable[$preparedUrl];

        return [
            'controller' => $routingData[0],
            'action' => $routingData[1],
            'params' => $params
        ];
    }

    /**
     * @param $url
     * @return mixed
     */
    protected function prepareUrl($url)
    {
        /** @var array $routingTable */
        $aliasedRouting = require_once __DIR__ . '/../../Resources/config/aliased_routing.php';
        $params = [];

        foreach ($aliasedRouting as $route) {
            list($url, $params) = $this->extractParameters($url, $route);
        }

        return [$url, $params];
    }

    /**
     * @param $url
     * @param $route
     * @return array
     */
    protected function extractParameters($url, $route)
    {
        $params = [];

        $len = strlen($route);
        if (substr($url, 0, $len) == $route) {
            $params['id'] = substr($url, $len + 1);
            $url = $route;
        }

        return [$url, $params];
    }
}
