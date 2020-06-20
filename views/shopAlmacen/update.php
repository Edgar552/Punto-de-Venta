<?php
/* @var $this ShopAlmacenController */
/* @var $model ShopAlmacen */

$this->breadcrumbs=array(
	'Inventario'=>array(''),
	'Actualizando Datos',
);

$this->menu=array(
	array('label'=>'Regresar al Almacen', 'url'=>array('admin')),
);
?>

<h1>Actualizando Item</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>