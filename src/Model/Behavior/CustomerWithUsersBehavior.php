<?php

class CustomerWithUsersBehavior extends ModelBehavior {

	public function setup(Model $Model, $config = array()) {
		$Model->bindModel(array(
			'hasMany' => array(
				'CustomerUser' => array(
					'className' => 'WebshopCustomerUsers.CustomerUser',
					'foreignKey' => 'customer_id'
				)
			)
		), false);
	}

	public function createWithUser(Model $Model, $data) {
		$data['Customer']['CustomerContact'][0]['name'] = $data['User']['name'];
		$data['Customer']['CustomerContact'][0]['email'] = $data['User']['email'];

		if ($data['Customer']['type'] === 'individual') {
			$data['Customer']['name'] = $data['User']['name'];
		}

		$data['Customer']['AddressDetails'][0]['name'] = $data['Customer']['name'];

		$Model->CustomerUser->create();
		$data['User']['role_id'] = 2; // Registered
		$data['User']['activation_key'] = md5(uniqid());
		$data['User']['status'] = 0;

		if (!$Model->CustomerUser->saveAssociated($data, array(
			'deep' => true
		))) {
			return false;
		}

		return $Model->CustomerUser->id;
	}

}