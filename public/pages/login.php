<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/auth.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader('Log In');
drawLoginForm();
drawFooter();
