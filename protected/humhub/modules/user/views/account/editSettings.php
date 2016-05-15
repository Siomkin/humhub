<?php

use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use \humhub\models\Setting;
?>

<div class="panel-heading">
    <?php echo Yii::t('UserModule.views_account_editSettings', '<strong>User</strong> settings'); ?>
</div>
<div class="panel-body">
    <?= humhub\modules\user\widgets\AccountSettingsMenu::widget(); ?>
    <br />
    <p />
    <?php $form = ActiveForm::begin(['id' => 'basic-settings-form']); ?>

    <?php echo $form->field($model, 'tags'); ?>

    <?php if(count($languages) > 1) : ?>
        <?php echo $form->field($model, 'language')->dropdownList($languages); ?>
    <?php endif; ?>

    <?php echo $form->field($model, 'timeZone')->dropdownList(\humhub\libs\TimezoneHelper::generateList()); ?>

    <?php if (Yii::$app->getModule('user')->settings->get('auth.allowGuestAccess')): ?>

        <?php
        echo $form->field($model, 'visibility')->dropdownList([
            1 => Yii::t('UserModule.views_account_editSettings', 'Registered users only'),
            2 => Yii::t('UserModule.views_account_editSettings', 'Visible for all (also unregistered users)'),
        ]);
        ?>


    <?php endif; ?>

    <?php if (Yii::$app->getModule('tour')->settings->get('enable') == 1) : ?>
        <?php echo $form->field($model, 'show_introduction_tour')->checkbox(); ?>
    <?php endif; ?>

    <?php if (Yii::$app->getModule('dashboard')->settings->get('share.enable') == 1) : ?>
        <?php echo $form->field($model, 'show_share_panel')->checkbox(); ?>
    <?php endif; ?>
    <hr>

    <?php echo CHtml::submitButton(Yii::t('UserModule.views_account_editSettings', 'Save'), array('class' => 'btn btn-primary', 'data-ui-loader' => '')); ?>

    <!-- show flash message after saving -->
    <?php echo \humhub\widgets\DataSaved::widget(); ?>

    <?php ActiveForm::end(); ?>
</div>
