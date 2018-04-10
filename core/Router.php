<?php
namespace projet4\core;

class Router {

    private static $routes = [
        // page : home
        'accueil' => [
            'path' => '/',
            'run' => 'PagesController@home'
        ],
        // page : contact
        'contact' => [
            'path' => '/contact',
            'run' => 'PagesController@contact'
        ],
        // page : all posts
        'chapitres' => [
            'path' => '/chapitres',
            'run' => 'PagesController@allPosts'
        ],
        // page : single post
        'chapitre' => [
            'path' => '/chapitre',
            'run' => 'PagesController@singlePost'
        ],
        // page : connect
        'connexion' => [
            'path' => '/connexion',
            'run' => 'PagesController@connect'
        ],
        // action : disconnect
        'deconnexion' => [
            'path' => '/deconnexion',
            'run' => 'PagesController@deconnect'
        ],
        // action : add a comment on a single post page into db
        'addComment' => [
            'path' => '/addComment',
            'run' => 'PagesController@newComment'
        ],
        // page : main admin interface
        'admin' => [
            'path' => '/admin',
            'run' => 'AdminController@admin'
        ],
        // page : new post
        'newPost' => [
            'path' => '/admin-newPost',
            'run' => 'AdminController@newPost'
        ],
        // action : add a new post into db
        'addNewPost' => [
            'path' => '/admin-addNewPost',
            'run' => 'AdminController@addNewPost'
        ],
        // page : edit post
        'editPost' => [
            'path' => '/admin-editPost',
            'run' => 'AdminController@editPost'
        ],
        // action : update a post into bd
        'updatePost' => [
            'path' => '/admin-updatePost',
            'run' => 'AdminController@updatePost'
        ],
        // action : delete a post
        'deletePost' => [
            'path' => '/admin-deletePost',
            'run' => 'AdminController@deletePost'
        ],
        // page : reported comments page
        'reportedComments' => [
            'path' => '/admin-reportedComments',
            'run' => 'AdminController@reportedComments'
        ],
        // action : report a comment to admin
        'reportComment' => [
            'path' => '/reportComment',
            'run' => 'PagesController@reportComment'
        ],
        // action : delete a comment
        'deleteComment' => [
            'path' => '/admin-deleteComment',
            'run' => 'AdminController@deleteComment'
        ],
        // action : remove reported tag of a comment
        'removeReportedTag' => [
            'path' => '/admin-removeReportedTag',
            'run' => 'AdminController@removeReportedTag'
        ],
        // page : shows all comments
        'allComments' => [
            'path' => '/admin-allComments',
            'run' => 'AdminController@allComments'
        ]
    ];

    /**
     * @return mixed|string
     * Get a path needed for dispatch() function
     */
    private function getPath() {
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace(BASE_URL, '', $url);
        $url = strtok($url, '?');
        return $url;
    }

    /**
     * Main function of this Router.
     * Depending on returned result of getPath(),
     * it will chose which Controller & method is needed.
     */
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

    /**
     * @param string $route
     * @return string
     * Generate an URL depending on the needed route
     */
    public static function getUrl(string $route) {
        $url = BASE_URL . self::$routes[$route]['path'];
        return $url;
    }
}