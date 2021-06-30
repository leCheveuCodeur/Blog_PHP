<?php

namespace Core\Controller;

use Core\Services\Globals\Globals;

class Controller
{
    protected $viewPath;
    protected $template;

    public function __construct()
    {
        $this->GET = $this->accessGlobal('GET');
        $this->POST = $this->accessGlobal('POST');
        $this->SERVER = $this->accessGlobal('SERVER');
        $this->SESSION = $this->accessGlobal('SESSION');
    }

    /**
     * Sends to the targeted View and sends the $variables
     * @param string $view ex: table.methode.attributs - 'post.show.1'
     * @param array $variables
     * @return void
     */
    protected function render(string $view, array $variables = [])
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
        \preg_match('/[\w\-\_]+(?=Controller)/im', \get_called_class(), $tableName);
        return $tableName[0];
    }

    /**
     * Return to the previous page
     * @return void
     */
    protected function previousPage()
    {
        if (isset($this->GET['return'])) {
            return \header('Location: index.php?p=' . $this->GET['return']);
        }
        return \header('Location: index.php');
    }

    /**
     * Format a date at the Local stardard
     * @param string $date
     * @return string
     */
    protected function formatDate(string $date)
    {
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $date = \strtotime($date);
        $day = strftime("%d ", $date);
        $day .= ucfirst(strftime("%B ", $date));
        return $day .= strftime("%G", $date);
    }

    /**
     * Management in the event of an error HTTP 403
     * @return void
     */
    protected function forbidden()
    {
        header("HTTP/1.0 403 Forbidden");
        return \header('Location: index.php?p=user.login');
    }

    /**
     * Management in the event of an error 404
     * @return void
     */
    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        return \header('Location: index.php');
    }

    /**
     * Add an XSS filter on the displayed datas
     * @param string $input
     * @return string
     */
    protected function antiXss(string $input)
    {
        return \nl2br(\htmlspecialchars($input), ENT_QUOTES);
    }

    /**
     * Secure get access to superglobals
     * @param string $global name of the superglobal targeted
     * @return mixed
     */
    public function accessGlobal(string $global)
    {
        $globals = new Globals;
        $global = 'get' . $global;
        return $globals->$global();
    }
}
