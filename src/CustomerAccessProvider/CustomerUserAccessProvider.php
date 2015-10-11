<?php

namespace Webshop\CustomerUsers\CustomerAccessProvider;

use Cake\Controller\Controller;
use Webshop\CustomerAccessProvider\CustomerAccessProvider;

/**
 * @property \Webshop\CustomerUsers\Model\Table\CustomerUsersTable CustomerUsers
 */
class CustomerUserAccessProvider extends CustomerAccessProvider
{

    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->loadModel('Webshop/CustomerUsers.CustomerUsers');
    }

    /**
     * {@inheritDoc}
     */
    public function getAccessibleCustomers(Controller $Controller)
    {
        if ($Controller->Auth->user() === null) {
            return false;
        }

        return $this->CustomerUsers->find('list', [
            'valueField' => 'customer_id'
        ])
            ->where([
                $this->CustomerUsers->alias() . '.user_id' => $Controller->Auth->user('id')
            ])->toArray();
    }
}
