<?php
/**
 * Created by PhpStorm.
 * User: asorokin
 * Date: 16.08.2018
 * Time: 11:40
 */

namespace app\modules\registration\models;


use yii\db\ActiveRecord;

class CustomerType extends ActiveRecord {

    public static function tableName() {
        return 'customer_type';
    }

    public function getCustomer() {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    public function rules() {
        return [
            [['inn','companyName'], 'string', 'max'=>255],
            [['customerType'], 'boolean'],
            [['inn'], 'required',
                'when'=>function($model) {return $model->customerType == true;},
                'whenClient' => "function (attribute, value) {
                    return $('#customerType').checked == true;
                }"
            ],
            [['companyName'], 'required', 'when'=>function($model) {return $model->customerType == false;},
                'whenClient' => "function (attribute, value) {
                    return $('#customerType').checked == false;
                }"
            ],
        ];
    }
}