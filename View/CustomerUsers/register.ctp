<?php
$this->Html->script('WebshopCustomerUsers.webshop_customer_users', array('inline' => false));

echo $this->Form->create('CustomerUser', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => array(
			'class' => 'col col-md-3 control-label'
		),
		'wrapInput' => 'col col-md-9',
		'class' => 'form-control'
	),
	'class' => 'well form-horizontal'
));
echo $this->Form->input('User.name', array('label' => __d('croogo', 'Name')));
echo $this->Form->input('User.username', array('label' => __d('croogo', 'Username')));
echo $this->Form->input('User.email', array('label' => __d('croogo', 'Email')));
echo $this->Form->input('User.password', array('label' => __d('croogo', 'Password')));
echo $this->Form->input('User.verify_password', array('label' => __d('croogo', 'Password verify'), 'type' => 'password'));
echo $this->element('Webshop.form/customer', array(
	'prefix' => 'Customer.',
	'subData' => true,
	'contactDetails' => false
));
echo $this->Form->submit(
	__d('webshop_customer_users', 'Create'),
	array(
		'class' => 'btn btn-primary'
	)
);
echo $this->Form->end();
