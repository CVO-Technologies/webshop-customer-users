<?php

namespace Webshop\CustomerUsers\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\Controller;
use Cake\Event\Event;

class CustomerUsersComponent extends Component {

	public function beforeRender(Event $event) {
        /** @var Controller $controller */
        $controller = $event->subject();
		$controller->loadModel('Webshop/CustomerUsers.CustomerUsers');

		$controller->set('isIndividualCustomer', $controller->CustomerUsers->isIndividualCustomer($controller->Auth->user('id')));
	}

	public function hasMethod() {
		debug(func_get_args());
	}

}
