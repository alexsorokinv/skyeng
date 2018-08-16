<?php

namespace app\modules\registration\models;

use yii\db\ActiveRecord;

class Customer extends ActiveRecord {

    public static function tableName() {
        return 'customer';
    }

    public function getCustomerType() {
        return $this->hasOne(CustomerType::className(), ['customerId'=>'id']);
    }

    public function rules()
    {
        return [
            [['firstName', 'secondName', 'lastName', 'email'], 'required'],
            [['firstName', 'secondName', 'lastName', 'email'], 'string', 'max'=>255],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }
}