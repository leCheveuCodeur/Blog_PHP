<?php

namespace Core\Controller;

class Controller
{
    protected $viewPath;
    protected $template;

    protected function render($view, $variables = [])
    {
        \ob_start();
        \extract($variables);
        require($this->viewPath . \str_replace('.', '/', $view) . '.php');
        $content = \ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }

    protected function previousPage()
    {
        if (isset($_GET['return'])) {
            return \header('Location: index.php?p=' . $_GET['return']);
        }
        return \header('Location: index.php');
    }

    protected function forbidden()
    {
        header("HTTP/1.0 403 Forbidden");
        die('Acces interdit');
        return \header('refresh:3;url=index.php');
    }

    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        die("Page introuvable");
    }

    protected function antiXss($input)
    {
        return \nl2br(\htmlspecialchars($input), ENT_QUOTES);
    }
}
