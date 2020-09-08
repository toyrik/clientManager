<?php
/**
 * @var $model \app\models\Customer
 */

?>

<h1>Create an account</h1>
<?php $form = \app\core\form\Form::begin('', "post"); ?>

<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'phone')?>
<?php echo $form->field($model, 'email')?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>
