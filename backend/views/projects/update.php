<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Projects */

$this->title = 'Update Projects: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->PID]];
$this->params['breadcrumbs'][] = 'Update';
?>

<!-- updates the view for projects -->

<div class="projects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
