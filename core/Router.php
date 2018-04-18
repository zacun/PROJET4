<?php
namespace projet4\core;

class Router {

    private static $routes = [
        /**************************/
        /** Pages related routes **/
        /**************************/
        /***** Public Pages *****/
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
            'run' => 'PagesController@connect'
        ],
        /***** Admin Pages *****/
        'admin' => [
            'path' => '/admin/',
            'run' => 'AdminController@admin'
        ],
        'newPost' => [
            'path' => '/admin/newPost',
            'run' => 'AdminController@newPost'
        ],
        'editPost' => [
            'path' => '/admin/editPost',
            'run' => 'AdminController@editPost'
        ],
        'reportedComments' => [
            'path' => '/admin/reportedComments',
            'run' => 'AdminController@reportedComments'
        ],
        'allComments' => [
            'path' => '/admin/allComments',
            'run' => 'AdminController@allComments'
        ],
        /****************************/
        /** Actions related routes **/
        /****************************/
        /***** Public actions *****/
        'getMailInfos' => [
            'path' => '/contact',
            'run' => 'PagesController@contact'
        ],
        'addComment' => [
            'path' => '/addComment',
            'run' => 'PagesController@newComment'
        ],
        'loginAdmin' => [
            'path' => '/login',
            'run' => 'AuthController@loginAdmin'
        ],
        /***** Admin actions *****/
        'logout' => [
            'path' => '/logout',
            'run' => 'AuthController@logout'
        ],
        'addNewPost' => [
            'path' => '/admin/addNewPost',
            'run' => 'AdminController@addNewPost'
        ],
        'updatePost' => [
            'path' => '/admin/updatePost',
            'run' => 'AdminController@updatePost'
        ],
        'deletePost' => [
            'path' => '/admin/deletePost',
            'run' => 'AdminController@deletePost'
        ],
        'reportComment' => [
            'path' => '/reportComment',
            'run' => 'PagesController@reportComment'
        ],
        'deleteComment' => [
            'path' => '/admin/deleteComment',
            'run' => 'AdminController@deleteComment'
        ],
        'removeReportedTag' => [
            'path' => '/admin/removeReportedTag',
            'run' => 'AdminController@removeReportedTag'
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
            Alert::setAlert('L\'adresse demandée n\'existe pas.', 'error');
            header('Location: ' . BASE_URL . '/');
            exit();
        }
        $controller = $controllerAndMethod[0];
        $method = $controllerAndMethod[1];
        $controller = 'projet4\src\controller\\' . $controller;
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