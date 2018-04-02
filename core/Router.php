<?php
namespace projet4\core;

class Router {

    private static $routes = [
        'home' => [
            'path' => '/',
            'run' => 'PagesController@home'
        ],
        'contact' => [
            'path' => '/contact',
            'run' => 'PagesController@contact'
        ],
        'allPosts' => [
            'path' => '/allPosts',
            'run' => 'PagesController@allPosts'
        ],
        'singlePost' => [
            'path' => '/singlePost',
            'run' => 'PagesController@singlePost'
        ],
        'connect' => [
            'path' => '/connect',
            'run' => 'AdminController@connect'
        ],
        'admin' => [
            'path' => '/admin',
            'run' => 'AdminController@admin'
        ],
        'newPost' => [
            'path' => '/newPost',
            'run' => 'AdminController@newPost'
        ],
        'reportedComments' => [
            'path' => '/reportedComments',
            'run' => 'AdminController@reportedComments'
        ]
    ];

    public function getPath() {
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