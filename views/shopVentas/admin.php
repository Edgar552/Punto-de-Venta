<?php
/* @var $this ShopVentasController */
/* @var $model ShopVentas */

$this->breadcrumbs=array(
	'Ventas'=>array(''),
	'Administrar',
);

$this->menu=array(
	//array('label'=>'List ShopVentas', 'url'=>array('index')),
	array('label'=>'Generar Nueva Venta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#shop-ventas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrador de Ventas</h1>

<p>
Registra y muestra las ventas realizadas, por orden de compra, número de ticket y vendedor
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shop-ventas-grid',
	'itemsCssClass'=>"table table-hover table-bordered",
	'pager'=>array("htmlOptions"=>array("class"=>"pagination")), //despues de 10 elementos pagina
	'emptyText'=>'No existen resultados de esta búsqueda', //cuando no existe algun registro muestra ese mensaje
	'summaryText'=>'{start}-{end} de {count} Items',// muestra el numero que ti
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_shop_ventas',
		'fecha_venta',
		'hora_venta',
		'numero_ticket',
		'venta_total',
		'nombre_vendedor',


		array(
			'class'=>'CButtonColumn',
			'header'=>'Acciones',
			'template'=>'{update}{delete}', //modifica mi tema y solo recibe las acciones que le indico
			'deleteConfirmation'=>('¿Desea borrar el ítem?'),
			'buttons'=>array(
					'update'=>array('rel'=>'tooltip',
					'options'=>array(
					'data-toggle'=>'tooltip',
					'title'=>Yii::t('app','Actualizar')
									),
				'label'=>'<i class="fa fa-refresh fa-2x"></i>',
				'imageUrl'=>false,
				'updateButtonUrl'=>'Yii::app()->controller->createUrl("update")',
							),


					'delete'=>array('rel'=>'tooltip',
					'options'=>array(
					'data-toggle'=>'tooltip',
					'title'=>Yii::t('app','Borrar')
									),
				'label'=>'<i class="fa fa-times fa-2x"></i>',
				'imageUrl'=>false,
				'updateButtonUrl'=>'Yii::app()->controller->createUrl("delete")',
							),	
				),
			),
	),
)); ?>
