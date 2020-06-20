<?php
require __DIR__ . '/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class ShopVentasController extends Controller
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
				'actions'=>array('create','update','ListProductosCodigo','GetDatosItem','GetNameProducto','GetNameMarca','GetNameTalla','GetTotalFinal','printTicket'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	
public function actionGetDatosItem()
{

	$CodigoBarras=$_POST['EnvioCodigo'];

	$GetBarras= ShopVentas::GetCodigoBarras($CodigoBarras);//ENVIA AL MODELO EL CONTENIDO RECIBIDO 
	$GetProductoID= ShopVentas::GetProductoID($CodigoBarras);//ENVIA AL MODELO EL CONTENIDO RECIBIDO 
	$GetMarcaID= ShopVentas::GetMarcaID($CodigoBarras);
	$GetTallaID= ShopVentas::GetTallaID($CodigoBarras);
	$GetPrecio= ShopVentas::GetPrecio($CodigoBarras);
//REGRESA A LA VISTA EL CONTENIDO DE LO QUE SE QUEDO ESCUCHANDO AL RECIBIR UNA PETICION EXITOSA --- CLAVE--- VALOR
	echo CJSON::encode(array('GetBarras'=>$GetBarras, 
								'GetProductoID'=>$GetProductoID,
								'GetMarcaID'=>$GetMarcaID,
								'GetTallaID'=>$GetTallaID,
								'GetPrecio'=>$GetPrecio));



}


	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionCreate()
	{		
	
		$model=new ShopVentas;
		$model_detalle_ventas=ShopDetalleVentas::listarVentas(0);

		if(isset($_POST['ShopVentas']))
		{
			$model->attributes=$_POST['ShopVentas'];

			$valid=$model->validate();
	

			if($valid)
			{

				$date= ''. date('Y').'-'. date('m').'-'. date('d').'';
				$time= '' . date('h') . ':' . date('i') . ':' . date("s");
				$model['fecha_venta']=$date;
				$model['hora_venta']=$time;

   		
				error_reporting(E_ALL ^ E_DEPRECATED);

			   $db_host = "localhost";
			   $db_user = "root";
			   $db_password = "";
			   $db_database ="mike_shop";
			   $conn = mysql_connect($db_host,$db_user,$db_password) or die(mysql_error());
			   $db = mysql_select_db($db_database,$conn)  or die(mysql_error()); 


		
/*
Este ejemplo imprime un hola mundo en una impresora de tickets
en Windows.
La impresora debe estar instalada como genérica y debe estar
compartida
 */

/*
Conectamos con la impresora
 */

/*
Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
escribe el nombre de la tuya. Recuerda que debes compartirla
desde el panel de control
 */

$nombre_impresora = "POS-80-series";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->setJustification(Printer::JUSTIFY_CENTER);

$logo = EscposImage::load("C:\wamp64\www\mikeshop\protected\controllers\mike_logo.png", false);
$printer->bitImage($logo);

//$printer->setTextSize(2, 2);
//$printer->text("MIKE'S SHOP");
//$printer->feed();

$printer->setTextSize(1, 1);
$printer->text("Escandón #102 Col. Centro Rioverde S.L.P.");
$printer->feed();
$printer->text("Número de Ticket: ");
$printer->text($model['numero_ticket']);
$printer->feed();

date_default_timezone_set("America/Mexico_City");

$printer->text("Fecha de Compra: ");
$printer->text(date("d-m-Y H:i:s") . "\n");
$printer->text("----------------------------------------" . "\n");
$printer->text("DETALLE DE SU COMPRA.\n");
$printer->feed();
$printer->setJustification(Printer::JUSTIFY_RIGHT); 

       $sql="
        SELECT 
             ptp.tipo_producto, pm.tipo_marca, pt.tipo_talla, precio_final
        FROM
            shop_detalle_ventas sdv

                INNER JOIN
            prod_tipo_producto ptp ON sdv.id_tipo_producto = ptp.id_tipo_producto
                INNER JOIN
            prod_marcas pm ON sdv.id_marca = pm.id_marca
                INNER JOIN
            prod_talla pt ON sdv.id_talla = pt.id_tipo_talla

        WHERE
            numero_ticket=".$model['numero_ticket']; 

        $result=mysql_query($sql,$conn) or die(mysql_error());
      
        while ($row = mysql_fetch_array($result)) 
        { 

			$printer->text($row['tipo_producto']); 
			$printer->text(" --"); 
			$printer->text($row['tipo_marca']); 
			$printer->text(" --"); 
			$printer->text($row['tipo_talla']);   
			$printer->text(" -- $"); 
			$printer->text($row['precio_final']. "\n");           
        }

        	$printer->feed();
			$printer->text("COSTO TOTAL: $");
			$printer->text($model['venta_total']);
			$printer->feed(2);
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$printer->text("¡GRACIAS POR SU COMPRA! VUELVA PRONTO");

			$printer->feed(1);
			$printer->text("Lo atendió:");
			$printer->text($model['nombre_vendedor']);


$printer->setTextSize(2, 1);
$printer->feed();
/*
Hacemos que el papel salga. Es como
dejar muchos saltos de línea sin escribir nada
 */
$printer->feed(3);

/*
Cortamos el papel. Si nuestra impresora
no tiene soporte para ello, no generará
ningún error
 */
$printer->cut();

/*
Por medio de la impresora mandamos un pulso.
Esto es útil cuando la tenemos conectada
por ejemplo a un cajón
 */
//$printer->pulse();

/*
Para imprimir realmente, tenemos que "cerrar"
la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
 */
$printer->close();

				$model->save();
				$this->redirect(array('admin'));
			}
		}

	if(Yii::app()->request->isAjaxRequest)

	{
		$model_detalle_ventas=null;
		$id=$_GET['numero_ticket'];
		$model_detalle_ventas=ShopDetalleVentas::listarVentas($id);
	}		

		$this->render('create',array(
			'model'=>$model,
			'model_detalle_ventas'=>$model_detalle_ventas
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
		$model_detalle_ventas=ShopDetalleVentas::listarVentas($model->numero_ticket);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ShopVentas']))
		{
			$model->attributes=$_POST['ShopVentas'];
			if($model->save())
				$this->redirect(array('admin'));
		}

	if(Yii::app()->request->isAjaxRequest)
	{
		$model_detalle_ventas=null;
		$id=$model['numero_ticket'];
		$model_detalle_ventas=ShopDetalleVentas::listarVentas($id);
	}		



		$this->render('update',array(
			'model'=>$model,
			'model_detalle_ventas'=>$model_detalle_ventas,
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
		$dataProvider=new CActiveDataProvider('ShopVentas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ShopVentas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ShopVentas']))
			$model->attributes=$_GET['ShopVentas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ShopVentas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ShopVentas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ShopVentas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shop-ventas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

		public function actionListProductosCodigo($term)
		{
		$sql="SELECT 
			  codigo_barras, ' ', id_tipo_producto, ' ', id_marca, ' ', id_talla, ' ', precio_producto
			

		 	  FROM 
		 	  mike_shop.shop_almacen 
			 
	     	  WHERE 
			  codigo_barras LIKE '%".$term."%'";



		$data=Yii::app()->db->createCommand($sql)->queryAll();

		$arr=array();

		foreach ($data as $item) 
		{

			$arr[]=array(
				'value'=>$item['codigo_barras'],
				'tipo'=>$item['id_tipo_producto'],
				'marca'=>$item['id_marca'],
				'talla'=>$item['id_talla'],
				'precio'=>$item['precio_producto']
				//'label'=>$item['nombre']

			
			);
		}
		echo CJSON::encode($arr);
	}


		public function actionGetNameProducto()
	{
		$id_producto=$_POST['id_producto'];
		$name_producto= ShopVentas::GetNameProducto($id_producto);
		echo CJSON::encode(array('name_producto'=>$name_producto));
	}

		public function actionGetNameMarca()
	{
		$id_marca=$_POST['id_marca'];
		$name_marca= ShopVentas::GetNameMarca($id_marca);
		echo CJSON::encode(array('name_marca'=>$name_marca));
	}


		public function actionGetNameTalla()
	{
		$id_talla=$_POST['id_talla'];
		$name_talla= ShopVentas::GetNameTalla($id_talla);
		echo CJSON::encode(array('name_talla'=>$name_talla));
	}

		public function actionGetTotalFinal()
	{
		$NumTicket=$_POST['numero_ticket'];
		$TotalFinal= ShopVentas::GetSumaDetalle($NumTicket);
		echo CJSON::encode(array('TotalFinal'=>$TotalFinal));
	}




}
