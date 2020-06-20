<?php
/* @var $this ProdTallaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prod Tallas',
);

$this->menu=array(
	array('label'=>'Create ProdTalla', 'url'=>array('create')),
	array('label'=>'Manage ProdTalla', 'url'=>array('admin')),
);
?>

<h1>Prod Tallas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
