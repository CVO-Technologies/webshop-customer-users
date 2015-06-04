<?php
$customerUsers = $this->requestAction(array('panel' => false, 'plugin' => 'webshop_customer_users', 'controller' => 'customer_users', 'action' => 'index'));
?>
<?php if (AuthComponent::user('id')): ?>
	<?php if (empty($customerUsers)): ?>
		<?php echo h(__d('webshop_customer_users', 'Your account doesn\'t appear to be tied to a customer. Would you like to become one?')); ?>
		<div class="btn-group btn-group-justified">
			<?php echo $this->Html->link(__d('webshop_customer_users', 'Become customer'), array('panel' => false, 'plugin' => 'webshop_customer_users', 'controller' => 'customer_users', 'action' => 'add_customer'), array('class' => 'btn btn-primary')); ?>
		</div>
	<?php elseif (count($customerUsers) === 1): ?>
<!--		--><?php //debug(Hash::extract($customerUsers, '{n}.Customer.name')); ?>
	<?php elseif (count($customerUsers) > 1): ?>
		<?php $customerNames = implode(', ', Hash::extract($customerUsers, '{n}.Customer.name')); ?>
		<p>
			<?php echo h(__d('webshop_customer_users', 'You have access to the following customers: %1$s', $customerNames)); ?>
		</p>
	<?php endif; ?>
<?php else: ?>
	<?php echo h(__d('webshop_customer_users', 'It looks like you\'re not logged in.')); ?>
	<div class="btn-group btn-group-justified">
		<?php echo $this->Html->link(__d('webshop_customer_users', 'Login'), array('panel' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Html->link(__d('webshop_customer_users', 'Create an account'), array('panel' => false, 'plugin' => 'webshop_customer_users', 'controller' => 'customer_users', 'action' => 'register'), array('class' => 'btn btn-success')); ?>
	</div>
<?php endif; ?>
