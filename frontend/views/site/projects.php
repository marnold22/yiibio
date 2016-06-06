 <?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kato\DropZone;
$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \kato\DropZone::widget([
       'options' => [
       	   'url' => 'http://localhost/yiibio/frontend/web/index.php?r=site/data',
           'maxFilesize' => '2',
       ],
       'clientEvents' => [
           'complete' => "function(file){console.log(file)}",
           'removedfile' => "function(file){alert(file.name + ' is removed')}"
       ],
   ]);
?>






