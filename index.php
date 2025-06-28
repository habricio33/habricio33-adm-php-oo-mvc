<?php

use App\adms\Controllers\Services\PageController;

require './vendor/autoload.php';

// intancia a classe PageController resposável para manipular a URL

$url = new PageController();

$url->loadPage();