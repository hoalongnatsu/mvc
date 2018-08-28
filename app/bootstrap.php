<?php
// Load config
require_once 'config/config.php';

// Load helpers
require_once  'helpers/url.php';
require_once 'helpers/session.php';

// Autoload core library
spl_autoload_register(function ($className) {
    require_once "libraries/$className.php";
});