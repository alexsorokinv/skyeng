<?php

/**
CREATE TABLE `customer` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`firstName` VARCHAR(255) NULL DEFAULT '0',
`secondName` VARCHAR(255) NULL DEFAULT '0',
`lastName` VARCHAR(255) NULL DEFAULT '0',
`email` VARCHAR(255) NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE INDEX `Индекс 2` (`email`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

CREATE TABLE `customer_type` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`customerId` INT(10) UNSIGNED NULL DEFAULT '0',
`customerType` TINYINT(3) UNSIGNED NULL DEFAULT '0',
`inn` VARCHAR(255) NULL DEFAULT '0',
`companyName` VARCHAR(255) NULL DEFAULT '0',
INDEX `Индекс 1` (`id`)
)
ENGINE=InnoDB
;



 *
 *
 */

namespace app\modules\registration\models;

use yii\base\Model;

class CustomerForm extends Model {
    /** @var  Customer */
    private $customer;
    /** @var  CustomerType */
    private $customerType;

    public function rules() {
        return [
            [['Customer'], 'required'],
            [['CustomerType'], 'required']
        ];
    }

    public function afterValidate() {
        $error = false;
        if (!$this->customer->validate()) {
            $error = true;
        }
        if (!$this->customerType->validate()) {
            $error = true;
        }
        if ($error) {
            $this->addError(null);
        }
        parent::afterValidate();
    }

    public function setCustomer($customer) {
        if ($customer instanceof Customer) {
            $this->customer = $customer;
        } elseif (is_array($customer)) {
            $this->customer->setAttributes($customer);
        }
    }

    public function setCustomerType($customerType) {
        if ($customerType instanceof CustomerType) {
            $this->customerType = $customerType;
        } elseif (is_array($customerType)) {
            $this->customerType->setAttributes($customerType);
        }
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function getCustomerType() {
        return $this->customerType;
    }

    public function save() {
        $result = true;
        if (!$this->validate()) {
            $result = false;
        } else {
            $transaction = \Yii::$app->db->beginTransaction();
            if (!$this->customer->save(false)) {
                $transaction->rollBack();
                $result = false;
            } else {
                $this->customerType->customerId = $this->customer->id;
                if (!$this->customerType->save(false)) {
                    $transaction->rollBack();
                    $result = false;
                } else {
                    $transaction->commit();
                }
            }
        }
        return $result;
    }
}