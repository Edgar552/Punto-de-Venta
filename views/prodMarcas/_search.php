<?php
/* @var $this ProdMarcasController */
/* @var $model ProdMarcas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_marca'); ?>
		<?php echo $form->textField($model,'id_marca'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_marca'); ?>
		<?php echo $form->textField($model,'tipo_marca',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_producto'); ?>
		<?php echo $form->textField($model,'id_tipo_producto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->