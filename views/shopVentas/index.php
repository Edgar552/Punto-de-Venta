<?php
/* @var $this ShopVentasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Shop Ventases',
);

$this->menu=array(
	array('label'=>'Create ShopVentas', 'url'=>array('create')),
	array('label'=>'Manage ShopVentas', 'url'=>array('admin')),
);
?>

<h1>Shop Ventases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
