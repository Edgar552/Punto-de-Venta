<?php
/* @var $this ProdTipoProductoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prod Tipo Productos',
);

$this->menu=array(
	array('label'=>'Create ProdTipoProducto', 'url'=>array('create')),
	array('label'=>'Manage ProdTipoProducto', 'url'=>array('admin')),
);
?>

<h1>Prod Tipo Productos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
