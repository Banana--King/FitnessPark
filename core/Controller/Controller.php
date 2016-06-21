<?php
namespace Core\Controller;

class Controller
{
    protected $viewPath;
    protected $template;

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace(".", "/", $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }
    
    protected function renderAjax($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace(".", "/", $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/ajax.php');
        echo $content;
    }


    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }


    protected function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }
    
    protected function setTemplate($template)
    {
        $this->template = $template;
    }
    
    protected function checkAuth($type)
    {
        if(isset($_SESSION['type']) && !empty($_SESSION['type'])) {
            if($_SESSION['type'] != 'admin' && $type == 'admin'){
                $this->forbidden();
            } elseif ($_SESSION['type'] == 'admin' && $type != 'admin'){
                $this->forbidden();
            }
        } else {
            $this->forbidden();
        }
    }
}