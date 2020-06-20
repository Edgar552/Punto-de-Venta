<?php
/* @var $this ProdMarcasController */
/* @var $model ProdMarcas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prod-marcas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_marca'); ?>
		<?php echo $form->textField($model,'tipo_marca',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'tipo_marca'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tipo_producto'); ?>
		<?php echo $form->textField($model,'id_tipo_producto'); ?>
		<?php echo $form->error($model,'id_tipo_producto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->