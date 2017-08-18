<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\siteParam\models\SiteParam */

$this->title = 'Update Site Param: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Site Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-param-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
