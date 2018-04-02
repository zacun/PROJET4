<?php
namespace projet4\core;

class Router {

    private static $routes = [
        'accueil' => [
            'path' => '/',
            'run' => 'PagesController@home'
        ],
        'contact' => [
            'path' => '/contact',
            'run' => 'PagesController@contact'
        ],
        'chapitres' => [
            'path' => '/chapitres',
            'run' => 'PagesController@allPosts'
        ],
        'chapitre' => [
            'path' => '/chapitre',
            'run' => 'PagesController@singlePost'
        ],
        'connexion' => [
            'path' => '/connexion',
            'run' => 'AdminController@connect'
        ],
        'admin' => [
            'path' => '/admin',
            'run' => 'AdminController@admin'
        ],
        'newPost' => [
            'path' => '/admin/newPost',
            'run' => 'AdminController@newPost'
        ],
        'reportedComments' => [
            'path' => '/admin/reportedComments',
            'run' => 'AdminController@reportedComments'
        ]
    ];

    private function getPath() {
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace(BASE_URL, '', $url);
        $url = strtok($url, '?');
        return $url;
    }

    public function dispatch() {
        $path = $this->getPath();
        foreach (self::$routes as $key => $values) {
            if ($path == $values['path']) {
                $controllerAndMethod = explode('@', $values['run']);
                break;
            }
        }
        if (!isset($controllerAndMethod)) {
            throw new \Exception('La route n\'a pas été trouvée');
        }
        $controller = $controllerAndMethod[0];
        $method = $controllerAndMethod[1];
        require_once '../src/controller/' . $controller . '.php';
        $controllerClass = new $controller;
        $controllerClass->$method();
    }

    public static function getUrl(string $route) {
        $url = BASE_URL . self::$routes[$route]['path'];
        return $url;
    }
}