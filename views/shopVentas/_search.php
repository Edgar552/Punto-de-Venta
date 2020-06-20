<?php
/* @var $this ShopVentasController */
/* @var $model ShopVentas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_shop_ventas'); ?>
		<?php echo $form->textField($model,'id_shop_ventas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_ticket'); ?>
		<?php echo $form->textField($model,'numero_ticket',array('size'=>60,'maxlength'=>65)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_venta'); ?>
		<?php echo $form->textField($model,'fecha_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_venta'); ?>
		<?php echo $form->textField($model,'hora_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'venta_total'); ?>
		<?php echo $form->textField($model,'venta_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_vendedor'); ?>
		<?php echo $form->textField($model,'nombre_vendedor',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->