<?php

class CustomerUsersComponent extends Component {

	public function beforeRender(Controller $Controller) {
		$Controller->loadModel('WebshopCustomerUsers.CustomerUser');

		$Controller->set('isIndividualCustomer', $Controller->CustomerUser->isIndividualCustomer($Controller->Auth->user('id')));
	}

	public function hasMethod() {
		debug(func_get_args());
	}

}
