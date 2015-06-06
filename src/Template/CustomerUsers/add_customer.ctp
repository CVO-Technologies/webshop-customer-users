<?php
echo $this->Form->create('CustomerUser', array(
	'class' => 'well form-horizontal'
));
$this->Form->templates([
    'div' => 'form-group',
    'wrapInput' => 'col col-md-9',
    'class' => 'form-control'
]);
echo $this->Form->hidden('CustomerUser.user_id', array(
	'value' => $loggedInUser->id
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
