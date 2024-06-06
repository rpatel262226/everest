<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Job Form';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .form-c{
        border: 1px solid gray;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 1px -1px 7px 1px;
    }
</style>
<div class="site-contact">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <div class="row flex-row justify-content-center border-red">
            <div class="col-lg-6 form-c">

                <?php $form = ActiveForm::begin(['id' => 'job-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                    <div class="row">
                        <div class="col-md-6">
                          <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="col-md-6">
                           <?= $form->field($model, 'email') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                             <?= $form->field($model, 'phone_number') ?>  
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'applied_position') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 flex-row">
                        <?php
                        echo $form->field($model, 'gender')->inline()->radioList( ['Male'=>'Male', 'Female' => 'Female'] );
                        // echo Html::radioList('gender', null, ['Male' => 'Male', 'Female' => 'Female'], ['class' => 'form-control input-sm radio d-flex flex-row justify-content-around']);?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'uploadResume')->fileInput(['multiple'=>'multiple']); ?>    
                        </div>
                    </div>
                    <!-- <div class="row"> -->
                        <!-- <div class="col-md-6"> -->
                             <!-- $form->field($model, 'uploadResume')->fileInput(['multiple'=>'multiple']);      -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-md-12">
                             <?= $form->field($model, 'coverLetter')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group d-flex flex-row justify-content-center">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>
