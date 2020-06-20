<?php
/* @var $this ShopAlmacenController */
/* @var $data ShopAlmacen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_almacen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_almacen), array('view', 'id'=>$data->id_almacen)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_barras')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_barras); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_producto')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_marca')); ?>:</b>
	<?php echo CHtml::encode($data->id_marca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_talla')); ?>:</b>
	<?php echo CHtml::encode($data->id_talla); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio_producto')); ?>:</b>
	<?php echo CHtml::encode($data->precio_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_alta')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_alta); ?>
	<br />


</div>