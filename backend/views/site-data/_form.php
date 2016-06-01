<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Projects;

/* @var $this yii\web\View */
/* @var $model backend\models\SiteData */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- This generates the form for creating/adding new data elements to projects -->


<div class="site-data-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!--<?= $form->field($model, 'PID')->textInput() ?>-->


    <p> Please select the project you would like to contribute data to. </p>

    <?= $form->field($model, 'PID')->dropDownlist(ArrayHelper::map(Projects::find()->all(), 'PID', 'Name'), 
        ['prompt' => 'Select Project']
        )->label('Project Title')?>



    <p> Please select the file destination. </p>


    <!--<?= $form->field($model, 'Location')->textInput(['maxlength' => true]) ?>-->
    
    <?= $form->field($model, 'file')->fileInput(); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
