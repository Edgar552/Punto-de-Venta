<?php

class ShopDetalleVentasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','AddItem','DeleteItem'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


public function actionAddItem()
{

		$accion='AddItem';

		$codigo_barras=$_POST['codigo_barras'];
		$id_tipo_producto=$_POST['id_tipo_producto'];
		$id_marca=$_POST['id_marca'];
		$id_talla=$_POST['id_talla'];
		$precio_producto=$_POST['precio_producto'];
		$descuento_aplicado=$_POST['descuento_aplicado'];
		$precio_final=$_POST['precio_final'];

		$numero_ticket=$_POST['numero_ticket'];

		$datos=array(
			'codigo_barras'=>$codigo_barras,
			'id_tipo_producto'=>$id_tipo_producto,
			'id_marca'=>$id_marca,
			'id_talla'=>$id_talla,
			'precio_producto'=>$precio_producto,
			'descuento_aplicado'=>$descuento_aplicado,
			'precio_final'=>$precio_final,
			
		);

		$service=new ShopDetalleVentas;
		
		$service->codigo_barras		= 	$codigo_barras;
		$service->id_tipo_producto 	= 	$id_tipo_producto;
		$service->id_marca 	= 	$id_marca;
		$service->id_talla 	= 	$id_talla;
		$service->precio_producto 	= 	$precio_producto;
		$service->descuento_aplicado 	= 	$descuento_aplicado;
		$service->precio_final 	= 	$precio_final;

		$service->numero_ticket 	= 	$numero_ticket;
		$service->fecha_venta=''. date('Y').'-'. date('m').'-'. date('d').'';

		$service->save();

		echo CJSON::encode(array(
			'status'=>'AddItem',
			'numero_ticket'=>$service->numero_ticket,
			'datos'=>$datos
			));

}

	public function actionDeleteItem()
	{

		//RECIBE EL VALOR DEL ARREGLO PARA USARLO EN LA CONSULTA DEL MODELO
		$IdDetalleProducto=$_POST['id_detalle'];
		//MANDA LLAMAR LA CONSULTA Y ENVÍA EL VALOR
		$CargarCredito= ShopDetalleVentas::GetCredito($IdDetalleProducto);
		//AQUI FINALIZA EL CALCULO DEL CREDITO, SI LA FUNCION SE INICIA DESPUES SE INICIALIZA COMO NULL DEBIDO A QUE EL VALOR FUE BORRADO ANTES DE PODER PROCESARLO

		
		//SE RECIBE EL VALOR DEL ARREGLO PARA USARLO EN LA CONSULTA
		$id_tabla_ticket=$_POST['id_tabla_ticket'];
		//EL CODIGO DE BARRAS SE EVÍA COMO NULL PERO SIRVE COMO BANDERA PARA ACTUALIZAR LA TABLA UNA VEZ TERMINADO EL PROCESO
		$codigo_barras=$_POST['codigo_barras'];

		$sql="DELETE FROM shop_detalle_ventas 
			WHERE
			    id_detalle_venta='";
		
		$connection=Yii::app()->db;

		foreach($id_tabla_ticket as $autoId){
			$command=$connection->createCommand($sql.$autoId."';");
			$command->execute();
		}

		echo CJSON::encode(
			array(
				'codigo_barras'=>$codigo_barras,
				'CargarCredito'=>$CargarCredito
				)
		);
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ShopDetalleVentas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ShopDetalleVentas']))
		{
			$model->attributes=$_POST['ShopDetalleVentas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_detalle_venta));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ShopDetalleVentas']))
		{
			$model->attributes=$_POST['ShopDetalleVentas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_detalle_venta));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ShopDetalleVentas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ShopDetalleVentas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ShopDetalleVentas']))
			$model->attributes=$_GET['ShopDetalleVentas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ShopDetalleVentas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ShopDetalleVentas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ShopDetalleVentas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shop-detalle-ventas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



}
