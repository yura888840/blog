<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:12
 */

namespace Blog\MVC;

class View
{
    /** @var \Twig_Environment */
    private $twig;

    public function __construct()
    {
        $templateDirectory = __DIR__ . '/../../Resources/views/';
        $loader = new \Twig_Loader_Filesystem($templateDirectory);
        $this->twig = new \Twig_Environment($loader);
    }

    public function render(string $template, array $params)
    {
        $rendered =
            $this->twig->render(
                sprintf("%s.html.twig", $template),
                $params
            );

        return $rendered;
    }
}