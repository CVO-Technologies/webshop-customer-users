<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::prefix('panel', function (RouteBuilder $routeBuilder) {
    $routeBuilder->plugin('Webshop/CustomerUsers', function (RouteBuilder $routeBuilder) {
        $routeBuilder->fallbacks();
    });
});
