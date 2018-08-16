<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'customer-form',
]) ?>

<?= $form->field($customerForm->customer, 'email')->textInput() ?>
<?= $form->field($customerForm->customer, 'firstName')->textInput() ?>
<?= $form->field($customerForm->customer, 'secondName')->textInput() ?>
<?= $form->field($customerForm->customer, 'lastName')->textInput() ?>

<?= $form->field($customerForm->customerType, 'customerType')->checkbox(['label'=>'Физ.Лицо']) ?>
<?= $form->field($customerForm->customerType, 'inn')->textInput() ?>
<?= $form->field($customerForm->customerType, 'companyName')->textInput() ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>