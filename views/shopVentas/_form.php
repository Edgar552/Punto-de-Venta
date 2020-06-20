<div class="form" onsubmit="return checkSubmit();" onKeypress="if(event.keyCode == 13) event.returnValue = false;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-ventas-form'
)); ?>



	<div class="row">
		<label>N° de Ticket:  </label>
		<?php echo $form->textField($model,'numero_ticket',
		($model->isNewRecord)?array('readOnly'=>'readOnly', 
									'value'=>rand(0,99999999).''. date('y')):array('readOnly'=>'readOnly')); ?>

		<?php echo $form->error($model,'numero_ticket'); ?>
	</div>

	<div class="row">
		<label>Crédito Disponible: </label>
		<?php echo $form->textField($model,'credito_disponible',
			($model->isNewRecord)?array('style'=>'display:none;')
				:array('display'=>'true','readOnly'=>'readOnly')); ?>
	</div>

<input type="number" id="contenedor_credito" placeholder="Producto" style="display: true;" value="<?php echo $model->credito_disponible ?>">

	<div class="row">
		<?php echo $form->textField($model,'fecha_venta',array('style'=>'display:none;'))?>
		<?php echo $form->error($model,'fecha_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->textField($model,'hora_venta',array('style'=>'display:none;')); ?>
		<?php echo $form->error($model,'hora_venta'); ?>
	</div>

<!--AÑADIR DETALLE DE VENTA EN ESTA PARTE -->

<div style="float:left;padding:10px;width: 100%">
	<h4>Productos</h4>
</div>

<div>
	<div class="row">
		<label>Producto </label>
<input type="text" id="codigo_barras" placeholder="Código de Barras" onKeypress="if(event.keyCode == 13) getItemContent();">
	
	<label>Descuento </label>
	  <select class="form-control" id="descuento_aplicado"  onclick="CalcularDescuento()">
		  <option value="OP">Seleccionar Descuento</option>
		  <option style="#B98F60;" value="0">&#9724; Standar 0% </option>
		  <option style="#A5A5A1;" value="5">&#9724; Select 5%</option>
		  <option style="#F6E01A;" value="10">&#9724; Advance 10%</option>
		   <option style="#F6E01A;" value="Credito">&#9724; Usar Crédito</option>
		</select>
<br>
<br>
		<a id="AddItem" class="btn btn-success" onclick="AddItem()"><i class="fa fa-plus"></i></a>		
		<a id="DeleteItem" class="btn btn-danger" onclick="DeleteItem()"><i class="fa fa-trash-o"></i></a>	

	</div>
</div>	

<br>

<input type="text" id="numero_ticket" placeholder="TICKET" value="<?php echo $model->numero_ticket ?>" style="display:none;">



<input type="text" id="id_tipo_producto" placeholder="Producto" style="display: none;">
<input type="text" id="tipo_producto" placeholder="Producto" style="display: true;" readonly="readOnly">

<input type="text" id="id_marca"  placeholder="Marca" style="display: none;">
<input type="text" id="tipo_marca" placeholder="Marca" style="display: true;" readonly="readOnly">

<input type="text" id="id_talla" placeholder="Talla" style="display: none;">
<input type="text" id="tipo_talla" placeholder="Talla" style="display: true;" readonly="readOnly">

<input type="number" id="precio_producto"  placeholder="ORIGINAL" style="display:true;">
<input type="number" id="precio_final"  placeholder="$ Precio Final" style="display: true;" readonly="readOnly">

<div style="float:left;padding:10px;width: 100%">
	<h5>Detalle Ticket</h4>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'table_detall_ventas',
	'itemsCssClass'=>"table table-condensed table-responsive table-hover table-bordered",
	'summaryText'=>'',
	'dataProvider'=>$model_detalle_ventas,
	//'filter'=>$model,
	'columns'=>array(
		
		array(
			'id'=>'id_detalle_venta',
			'class'=>'CCheckBoxColumn',
			'selectableRows'=>'1',
			
			 ),

				array(
			'name'=>'tipo_producto',
			'header'=>'Producto',
					),

				array(
			'name'=>'tipo_marca',
			'header'=>'Marca',
					),

				array(
			'name'=>'tipo_talla',
			'header'=>'Talla',
					),

				array(
			'name'=>'precio_final',
			'header'=>'Precio Unitario Final'),


			),

	)); 
 ?>





	<div class="row">
		<label>Venta Total</label>
		<?php echo $form->textField($model,'venta_total', array('readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'venta_total'); ?>
		
	</div>

	<div class="row">
		<label>Vendedor</label>
		<?php echo $form->dropDownList($model,'nombre_vendedor',array('Walls'=>'Walls',
														'Lalo'=>'Lalo',
														'José'=>'José',
														'Tomas'=>'Tomas',
														'Mike'=>'Mike',
														'Ari'=>'Ari'),
											($model->isNewRecord)?array('prompt'=>'Seleccione Vendedor'):array('disabled'=>'true')); ?>

		<?php echo $form->error($model,'nombre_vendedor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Generar Venta' : 'Actualizar',array('id'=>'btsubmit')); ?>															
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	function checkSubmit() 
	{
    	document.getElementById("btsubmit").value = "Enviando datos...";
    	document.getElementById("btsubmit").disabled = true;
    	return true;
	}
</script>

  <script>
  	
  	function getItemContent()
  	{
  		var CodigoScript=$('#codigo_barras').val();
  			//alert('CÓDIGO DEL ITEM' + ' ' + CodigoScript);

		<?php echo CHtml::ajax(array(
			'url'=>array('ShopVentas/GetDatosItem'),
			'data'=>array(
				'EnvioCodigo'=>'js:CodigoScript'
			),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				
				$('#id_tipo_producto').val(data.GetProductoID);
				GetNameProducto(data.GetProductoID);

				$('#id_marca').val(data.GetMarcaID);
				GetNameMarca(data.GetMarcaID);


				$('#id_talla').val(data.GetTallaID);
				GetNameTalla(data.GetTallaID);


				$('#precio_producto').val(data.GetPrecio);
				numero_ticket.value=ShopVentas_numero_ticket.value;


			}"
		))?>;

  	}

  </script>


<script>
	function GetNameProducto(id_producto) {
		<?php echo CHtml::ajax(array(
			'url'=>array('ShopVentas/GetNameProducto'),
			'data'=>array(
				'id_producto'=>'js:id_producto'
			),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				$('#tipo_producto').val(data.name_producto);
			}"
		))
		?>;	
	}
</script>  


<script>
	function GetNameMarca(id_marca) {
		<?php echo CHtml::ajax(array(
			'url'=>array('ShopVentas/GetNameMarca'),
			'data'=>array(
				'id_marca'=>'js:id_marca'
			),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				$('#tipo_marca').val(data.name_marca);
			}"
		))
		?>;	
	}
</script> 

<script>
	function GetNameTalla(id_talla) {
		<?php echo CHtml::ajax(array(
			'url'=>array('ShopVentas/GetNameTalla'),
			'data'=>array(
				'id_talla'=>'js:id_talla'
			),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				$('#tipo_talla').val(data.name_talla);
			}"
		))
		?>;	
	}
</script> 


  <script >
  	
  	function CalcularDescuento()
  	{
			$("#descuento_aplicado").change(function()
				{
					var valores=$("#descuento_aplicado").val();

					switch(valores)

					{
	
						case '0':
						
						precio_final.value=$("#precio_producto").val();
						ShopVentas_credito_disponible.value=contenedor_credito.value

						break;


						case '5':

						var precio_inicial=$("#precio_producto").val();
						var descuento=precio_inicial*5/100;
						var resultado=precio_inicial-descuento;

						precio_final.value=resultado;
						ShopVentas_credito_disponible.value=contenedor_credito.value

						break;

						case '10':

						var precio_inicial=$("#precio_producto").val();
						var descuento=precio_inicial*10/100;
						var resultado=precio_inicial-descuento;

						precio_final.value=resultado;
						ShopVentas_credito_disponible.value=contenedor_credito.value

						break;


						case 'Credito':

						var producto=$('#precio_producto').val();
						var credito=$('#contenedor_credito').val();
						var resultado_credito;

						
						if (parseInt(producto)>=parseInt(credito)) 
						{ 
							resultado_credito=parseInt(producto)-parseInt(credito);
							precio_final.value=resultado_credito;
							ShopVentas_credito_disponible.value=0;
						}

						if (parseInt(producto)<=parseInt(credito)) 
						{
							precio_final.value=0;
							ShopVentas_credito_disponible.value=contenedor_credito.value-precio_producto.value;
						}
						

						break;
					}
					

				});


  	}

  </script>


  	<script>
		function AddItem()
		{
					
			var guarda=$('#AddItem').val();
			
			var barras=$('#codigo_barras').val();
			var producto=$('#id_tipo_producto').val();
			var marca=$('#id_marca').val();
			var talla=$('#id_talla').val();
			var precio=$('#precio_producto').val();
			var descuento=$('#descuento_aplicado').val();
			var final=$('#precio_final').val();

			var credito_original=$('#ShopVentas_credito_disponible').val();
			var credito_contenedor=$('#contenedor_credito').val();
			

			var ticket_content=$('#numero_ticket').val();	

			if (ticket_content=='') 

			{
				ticket_content=$('#ticket_content').val();	
			}

			if (ticket_content==null)
			{

			alertify.error('Error: Escanea un Item');

			}
			else

			if (descuento=='OP')
			{

			alertify.alert('Error: Selecciona un descuento');

			}
			else
			{
			<?php echo CHtml::ajax(array(
	            'url'=>array('ShopDetalleVentas/AddItem'),
	            'data'=> array(
	            	'AddItem'=>"js:guarda",
	            	'codigo_barras'=>'js:barras',
	            	'id_tipo_producto'=>'js:producto',
	            	'id_marca'=>'js:marca',
	            	'id_talla'=>'js:talla',
	            	'precio_producto'=>'js:precio',
	            	'descuento_aplicado'=>'js:descuento',
	            	'precio_final'=>'js:final',

	            	'numero_ticket'=>'js:ticket_content'
	            ),
	            'type'=>'post',
	            'dataType'=>'json',
	            'success'=>"function(data)
	            {	 
	       		alertify.success('Articulo Añadido');
				$.fn.yiiGridView.update('table_detall_ventas',{data:{'numero_ticket':data.numero_ticket}});

				CalcularTotalFinal(ShopVentas_numero_ticket.value);
				
				
				numero_ticket.value=null;

				codigo_barras.value=null;
				descuento_aplicado.value='OP';

				id_tipo_producto.value=null;
				tipo_producto.value=null;

				id_marca.value=null;
				tipo_marca.value=null;

				id_talla.value=null;
				tipo_talla.value=null;

				precio_producto.value=null;
				precio_final.value=''


	            }"))?>;
			}
				return false; 			
		};
	</script>


	<script>
		function DeleteItem() 
		{
		var id_tabla_ticket=$.fn.yiiGridView.getChecked('table_detall_ventas', 'id_detalle_venta');
		var id_detalle=id_tabla_ticket[0];
		var barras=$('#codigo_barras').val();

		


		<?php echo CHtml::ajax(array(
			
            'url'=>array('ShopDetalleVentas/DeleteItem'),
            'data'=> array(
            	'id_tabla_ticket'=>'js:id_tabla_ticket',
            	'id_detalle'=>'js:id_detalle',
            	'codigo_barras'=>'js:barras',

            ),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            
            alertify.error('Se Eliminó Correctamente');	
			$.fn.yiiGridView.update('table_detall_ventas',{data:{'numero_ticket':data.numero_ticket}});

			$('#ShopVentas_credito_disponible').val(data.CargarCredito);
			$('#contenedor_credito').val(data.CargarCredito);

			CalcularTotalFinal(ShopVentas_numero_ticket.value);


            } "
            ))?>;		
		}
	</script>



<script>
	
//document.getElementById("AddItem").addEventListener("click", CalcularTotalFinal);

function CalcularTotalFinal(numero_ticket) {

		<?php echo CHtml::ajax(array(
			'url'=>array('ShopVentas/GetTotalFinal'),
			'data'=>array(
				'numero_ticket'=>'js:numero_ticket'
			),
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{

				$('#ShopVentas_venta_total').val(data.TotalFinal);


			}"
		))
		?>;
  
}
</script>

