<?php
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
echo $this->Form->hidden('CustomerUser.user_id', array(
	'value' => AuthComponent::user('id')
));
echo $this->element('Webshop.form/customer', array(
	'prefix' => 'Customer.',
	'subData' => true
));
echo $this->Form->submit(
	__d('webshop_customer_users', 'Create'),
	array(
		'class' => 'btn btn-primary'
	)
);
echo $this->Form->end();
