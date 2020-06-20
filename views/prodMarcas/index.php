<?php
/* @var $this ProdMarcasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prod Marcases',
);

$this->menu=array(
	array('label'=>'Create ProdMarcas', 'url'=>array('create')),
	array('label'=>'Manage ProdMarcas', 'url'=>array('admin')),
);
?>

<h1>Prod Marcases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
