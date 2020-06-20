<?php
/* @var $this ShopDetalleVentasController */
/* @var $model ShopDetalleVentas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-detalle-ventas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_barras'); ?>
		<?php echo $form->textField($model,'codigo_barras',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'codigo_barras'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tipo_producto'); ?>
		<?php echo $form->textField($model,'id_tipo_producto'); ?>
		<?php echo $form->error($model,'id_tipo_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_marca'); ?>
		<?php echo $form->textField($model,'id_marca'); ?>
		<?php echo $form->error($model,'id_marca'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_talla'); ?>
		<?php echo $form->textField($model,'id_talla'); ?>
		<?php echo $form->error($model,'id_talla'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio_producto'); ?>
		<?php echo $form->textField($model,'precio_producto'); ?>
		<?php echo $form->error($model,'precio_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_ticket'); ?>
		<?php echo $form->textField($model,'numero_ticket',array('size'=>60,'maxlength'=>65)); ?>
		<?php echo $form->error($model,'numero_ticket'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->