<?php

namespace Webshop\CustomerUsers\CustomerAccessProvider;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Webshop\CustomerAccessProvider\CustomerAccessProvider;

class CustomerUserAccessProvider extends CustomerAccessProvider
{

    public function __construct()
    {
        $this->CustomerUsers = TableRegistry::get('Webshop/CustomerUsers.CustomerUsers');
    }

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
