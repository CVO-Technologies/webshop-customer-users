<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin('Webshop/CustomerUsers', function (RouteBuilder $routeBuilder) {
    $routeBuilder->fallbacks();
});

Router::prefix('panel', function (RouteBuilder $routeBuilder) {
    $routeBuilder->plugin('Webshop/CustomerUsers', function (RouteBuilder $routeBuilder) {
        $routeBuilder->fallbacks();
    });
});
