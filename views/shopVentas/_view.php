<?php
/* @var $this ShopVentasController */
/* @var $data ShopVentas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_shop_ventas')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_shop_ventas), array('view', 'id'=>$data->id_shop_ventas)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->numero_ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_venta')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_venta')); ?>:</b>
	<?php echo CHtml::encode($data->hora_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('venta_total')); ?>:</b>
	<?php echo CHtml::encode($data->venta_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_vendedor')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_vendedor); ?>
	<br />


</div>