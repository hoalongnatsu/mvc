<?php
/**
 * App Core Class
 * Create url and load core controller
 * URL format - controller/method/params
 */

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    /**
     * Core constructor.
     */
    public function __construct()
    {
        $url = $this->getUrl();

        // Look in controllers
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
        {
            $this->currentController = ucwords($url[0]);

            unset($url[0]);
        }

        require_once "../app/controllers/{$this->currentController}.php";

        $this->currentController = new $this->currentController;

        if (isset($url[1]))
        {
            if (method_exists($this->currentController, $url[1]))
            {
                $this->currentMethod = $url[1];

                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        // Call callback with array params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    private function getUrl()
    {
		// echo $_GET['url'];
		// exit();
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}