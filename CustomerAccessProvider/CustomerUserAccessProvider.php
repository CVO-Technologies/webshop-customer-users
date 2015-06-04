<?php

App::uses('CustomerAccessProvider', 'Webshop.CustomerAccessProvider');
App::uses('CustomerUser', 'WebshopCustomerUser.Model');

class CustomerUserAccessProvider extends CustomerAccessProvider {

	public function __construct() {
		$this->CustomerUser = ClassRegistry::init('WebshopCustomerUsers.CustomerUser');
	}

	public function getAccessibleCustomers(Controller $Controller) {
		if ($Controller->Auth->user() === null) {
			return false;
		}

		return array_values($this->CustomerUser->find('list', array(
			'fields' => array(
				$this->CustomerUser->alias . '.customer_id'
			),
			'conditions' => array(
				$this->CustomerUser->alias . '.user_id' => $Controller->Auth->user('id')
			)
		)));
	}

}