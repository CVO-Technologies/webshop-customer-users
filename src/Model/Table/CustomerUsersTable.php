<?php

namespace Webshop\CustomerUsers\Model\Table;

use Cake\ORM\Table;

class CustomerUsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo('Customers', [
            'className' => 'Webshop.Customers',
        ]);
        $this->belongsTo('Users', [
            'className' => 'Croogo/Users.Users',
        ]);
    }


    public function isIndividualCustomer($userId)
    {
		return ($this->find()->where([
            $this->alias() . '.user_id' => $userId,
            'Customers.type' => 'individual'
        ])->contain(['Customers'])->count() >= 1);
	}

}
