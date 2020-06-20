<?php
/* @var $this ProdTallaController */
/* @var $model ProdTalla */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_talla'); ?>
		<?php echo $form->textField($model,'id_tipo_talla'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_talla'); ?>
		<?php echo $form->textField($model,'tipo_talla',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->