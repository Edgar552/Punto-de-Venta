<?php
/* @var $this ShopAlmacenController */
/* @var $model ShopAlmacen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_almacen'); ?>
		<?php echo $form->textField($model,'id_almacen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_barras'); ?>
		<?php echo $form->textField($model,'codigo_barras',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_producto'); ?>
		<?php echo $form->textField($model,'id_tipo_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_marca'); ?>
		<?php echo $form->textField($model,'id_marca'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_talla'); ?>
		<?php echo $form->textField($model,'id_talla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'precio_producto'); ?>
		<?php echo $form->textField($model,'precio_producto',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_alta'); ?>
		<?php echo $form->textField($model,'fecha_alta',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->