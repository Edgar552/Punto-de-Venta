<?php
/* @var $this ProdMarcasController */
/* @var $data ProdMarcas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_marca')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_marca), array('view', 'id'=>$data->id_marca)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_marca')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_marca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_producto')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_producto); ?>
	<br />


</div>