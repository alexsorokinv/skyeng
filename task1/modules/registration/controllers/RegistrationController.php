<?php

namespace app\modules\registration\controllers;

use app\modules\registration\models\Customer;
use app\modules\registration\models\CustomerForm;
use app\modules\registration\models\CustomerType;
use yii\web\Controller;

class RegistrationController extends Controller {

    public function actionRegistration() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $customerForm = new CustomerForm();
        $customerForm->customer = new Customer();
        $customerForm->customerType = new CustomerType();
        $customerForm->setAttributes(\Yii::$app->request->post());
        if (\Yii::$app->request->post() && $customerForm->save()) {
            return $this->goHome();
        }

        return $this->render('index', [
            'customerForm' => $customerForm,
        ]);
    }

}