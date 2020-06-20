<?php
/* @var $this ShopAlmacenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Inventario',
);

$this->menu=array(
	array('label'=>'Cargar Nuevo Item', 'url'=>array('create')),
	array('label'=>'Administrar Inventario', 'url'=>array('admin')),
);
?>

<h1>Shop Almacens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
