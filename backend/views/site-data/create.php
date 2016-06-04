<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SiteData */

$this->title = 'Create Site Data';
$this->params['breadcrumbs'][] = ['label' => 'Site Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Initializes the backend for a site-data page -->

<div class="site-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
