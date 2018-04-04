<?php
namespace projet4\core;

class Controller {

    protected $viewPath = '../views/';
    protected $template = 'default';
    protected $title = 'F. Jean';

    public function render(string $view, $variables = []) {
        ob_start();
        extract($variables);
        $title = $this->getTitle($view);
        require($this->viewPath . $view .'.php');
        $content = ob_get_clean();
        require($this->viewPath . 'template/' . $this->template . '.php');
    }

    public function renderAdmin(string $view, $variables = []) {
        ob_start();
        extract($variables);
        $title = $this->getTitle($view);
        require($this->viewPath . 'admin/' . $view .'.php');
        $content = ob_get_clean();
        require($this->viewPath . 'template/' . $this->template . 'Admin' . '.php');
    }


    public function getTitle(string $view) {
        $title = $this->title . ' | ' . ucfirst(str_replace('admin/', '', $view));
        return $title;
    }

    public static function getExcerpt(string $excerpt, int $length, bool $dot = true) {
        if ($dot == false) {
            return substr($excerpt, 0, $length);
        } else {
            return substr($excerpt, 0, $length) . '...';
        }
    }

}