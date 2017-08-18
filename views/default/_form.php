<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\modules\siteParam\models\SiteParam;

/* @var $this yii\web\View */
/* @var $model common\modules\siteParam\models\SiteParam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-param-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->dropDownList(SiteParam::getNames(), ['prompt' => Yii::t('app', 'Select one...')]) ?>

    <?= $form->field($model, 'value')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
