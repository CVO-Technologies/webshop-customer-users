<?php

App::uses('AppController', 'Controller');

class CustomerUsersController extends AppController {

	public $components = array(
		'Paginator'
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Security->unlockedActions = array(
			'register'
		);
	}

	public function index() {
		$customerUsers = $this->Paginator->paginate('CustomerUser', array(
			'CustomerUser.user_id' => $this->Auth->user('id')
		));

		if ($this->request->is('requested')) {
			return $customerUsers;
		}
	}

	public function add_customer() {
		if (!$this->request->is('post')) {
			return;
		}

		$this->request->data[$this->CustomerUser->alias]['user_id'] = $this->Auth->user('id');

		if (!$this->CustomerUser->saveAssociated($this->request->data, array(
			'deep' => true
		))) {
			$this->Session->setFlash(__d('webshop_customer_users', 'Could not store the customer information'), 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
			));

			return;
		}

		$customerUser = $this->CustomerUser->find('first', array(
			'conditions' => array(
				'CustomerUser.id' => $this->CustomerUser->id
			),
			'recursive' => -1
		));

		$this->redirect(array('prefix' => false, 'plugin' => 'webshop', 'controller' => 'customers', 'action' => 'view', $customerUser['CustomerUser']['customer_id']));
	}

	public function register() {
		if (!$this->request->is('post')) {
			return;
		}

		$customerUserId = $this->CustomerUser->Customer->createWithUser($this->request->data);

		if (!$customerUserId) {
			Croogo::dispatchEvent('Controller.Users.registrationFailure', $this);
			$this->Session->setFlash(__d('croogo', 'The User could not be saved. Please, try again.'), 'flash', array('class' => 'error'));

			return;
		}

		$customerUser = $this->CustomerUser->find('first', array(
			'conditions' => array(
				'CustomerUser.id' => $customerUserId
			),
			'recursive' => -1
		));
		$user = $this->CustomerUser->User->read(null, $customerUser['CustomerUser']['user_id']);

		Croogo::dispatchEvent('Controller.Users.registrationSuccessful', $this);

		$this->_sendEmail(
			array(Configure::read('Site.title'), $this->_getSenderEmail()),
			$user['User']['email'],
			__d('croogo', '[%s] Please activate your account', Configure::read('Site.title')),
			'Users.register',
			'user activation',
			$this->theme,
			array('user' => $user)
		);

		$this->Session->setFlash(__d('croogo', 'You have successfully registered an account. An email has been sent with further instructions.'), 'flash', array('class' => 'success'));
		$this->redirect(array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
		return;
	}

	/**
	 * Convenience method to send email
	 *
	 * @param string $from Sender email
	 * @param string $to Receiver email
	 * @param string $subject Subject
	 * @param string $template Template to use
	 * @param string $theme Theme to use
	 * @param array  $viewVars Vars to use inside template
	 * @param string $emailType user activation, reset password, used in log message when failing.
	 * @return boolean True if email was sent, False otherwise.
	 */
	protected function _sendEmail($from, $to, $subject, $template, $emailType, $theme = null, $viewVars = null) {
		if (is_null($theme)) {
			$theme = $this->theme;
		}
		$success = false;

		try {
			$email = new CakeEmail();
			$email->from($from[1], $from[0]);
			$email->to($to);
			$email->subject($subject);
			$email->template($template);
			$email->viewVars($viewVars);
			$email->theme($theme);
			$success = $email->send();
		} catch (SocketException $e) {
			$this->log(sprintf('Error sending %s notification : %s', $emailType, $e->getMessage()));
		}

		return $success;
	}

	protected function _getSenderEmail() {
		return 'croogo@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
	}
	
}
