<?php

use Croogo\Core\Croogo;
use Croogo\Core\Nav;

Nav::add('webshop-customer-dashboard', 'users', array(
	'title' => __d('webshop_customer_users', 'Users'),
	'url' => array(
		'prefix' => 'panel',
		'plugin' => 'Webshop/CustomerUsers',
		'controller' => 'CustomerUsers',
		'action' => 'index'
	),
));

Croogo::hookBehavior('Customer', 'Webshop/CustomerUsers.CustomerWithUsers');

Croogo::hookComponent('*', [
    'CustomerUsersComponent' => [
        'className' => 'Webshop/CustomerUsers.CustomerUsers'
    ]
]);

Croogo::mergeConfig('Webshop.customer_access_providers', array(
	'CustomerUsers' => array(
		'provider' => 'Webshop/CustomerUsers.CustomerUser'
	),
));
