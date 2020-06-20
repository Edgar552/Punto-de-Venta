<?php
/* @var $this ShopDetalleVentasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Shop Detalle Ventases',
);

$this->menu=array(
	array('label'=>'Create ShopDetalleVentas', 'url'=>array('create')),
	array('label'=>'Manage ShopDetalleVentas', 'url'=>array('admin')),
);
?>

<h1>Shop Detalle Ventases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
