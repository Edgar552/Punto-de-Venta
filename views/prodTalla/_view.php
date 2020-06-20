<?php
/* @var $this ProdTallaController */
/* @var $data ProdTalla */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_talla')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tipo_talla), array('view', 'id'=>$data->id_tipo_talla)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_talla')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_talla); ?>
	<br />


</div>