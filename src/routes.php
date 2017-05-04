<?php
// Routes

use App\Controller\ParseUrlController;

$app->get('/[{path:.*}]', function($request, $response) {
    return (new ParseUrlController($request, $response, $this->renderer))->parseUrl();
});