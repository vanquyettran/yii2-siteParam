<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\siteParam\models\SiteParam */

$this->title = 'Create Site Param';
$this->params['breadcrumbs'][] = ['label' => 'Site Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-param-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
