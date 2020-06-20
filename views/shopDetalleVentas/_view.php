<?php
/* @var $this ShopDetalleVentasController */
/* @var $data ShopDetalleVentas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_detalle_venta')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_detalle_venta), array('view', 'id'=>$data->id_detalle_venta)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->numero_ticket); ?>
	<br />


</div>