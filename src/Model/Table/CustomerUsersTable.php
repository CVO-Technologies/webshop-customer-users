<?php

namespace Webshop\CustomerUsers\Model\Table;

use Cake\ORM\Table;

class CustomerUsersTable extends Table {

	public $actsAs = array(
		'Containable'
	);

	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Webshop.Customer',
			'foreignKey' => 'customer_id'
		),
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id'
		)
	);

	public function isIndividualCustomer($userId) {
		return ($this->find('count', array(
			'conditions' => array(
				$this->alias . '.user_id' => $userId,
				'Customer.type' => 'individual'
			),
			'contain' => array(
				'Customer'
			)
		)) >= 1);
	}

}
