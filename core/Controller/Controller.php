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

    /**
     * Get the name of the table associated with the controller
     * @return string ex : 'Post'
     */
    protected function tableName()
    {
        $path = \explode('\\', \get_called_class());
        return $tableName = \str_replace('Controller', '', $path[2]);
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

    /**
     * Paging of the past SQL statement
     * @param null|int $page of the paging system
     * @param string $statement
     * @param int $limit number of elements returned per page
     * @param null|array $attributes
     * @return array with the \compat function | !! use \extract to retrieve variables
     */
    public function paging(?int $page = \null, string $statement, int $limit, ?array $attributes = \null): array
    {
        $rows = \lcfirst($this->table . 's');
        $table = $this->table;

        $nbRows = $this->$table->countRows($statement, $attributes);
        $nbPages = \ceil($nbRows / $limit);
        $page = !empty($page) && $page <= $nbPages ? $page : 1;
        // add the offest to the base SQL statement
        $$rows = $this->$table->offset($statement, $attributes, $limit, $page);

        // manages the disabling of the previous and following btn
        $previous = $page === 1 ? ' disabled' : \null;
        $next = $page >= $nbPages ? ' disabled' : \null;

        return \compact('nbPages', 'page', $rows, 'previous', 'next');
    }
}
