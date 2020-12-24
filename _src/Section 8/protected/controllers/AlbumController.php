<?php

class AlbumController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		        'checkOwner + update, upload, delete'
		);
	}

	/*
	 * Check the user owns this record
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function filtercheckOwner($filterChain)
	{
	    if ($id=Yii::app()->getRequest()->getParam('id')) {
		$model=$this->loadModel($id);
		if ($model->owner_id == Yii::app()->user->id)
		    $filterChain->run();
		else throw new CHttpException(404, "The Requested Album is not Available");
	    }
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
				'actions'=>array('index','view','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'upload', 'admin','delete','suggestTags'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	** Search called from theme menubar
	** and also tag links
	** using GET
	**/
	 public function actionSearch(){
	 	
	    if (isset($_GET['tag'])) {
		$search=$_GET['tag'];
		$criteria=new CDbCriteria;
		$criteria->addSearchCondition('tags',$search);
		
		$criteria->scopes='shareable';
            
		$dataProvider=new CActiveDataProvider('Album', array(
			'criteria'=>$criteria,
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'tags'=>$search
		));
		}
	}
		/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $photos=$dataProvider=new CActiveDataProvider('Photo', array(
                    'criteria'=>array(
                        'condition'=>'album_id=:aid',
                        'params'=>array(':aid'=>$id)
                    )
                ));
		
                $this->render('view',array(
			'model'=>$this->loadModel($id),
                        'photos'=>$photos,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Album;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if($model->save())  {
                            Yii::app()->user->setFlash('saved', "Data saved!");
                            $this->redirect(array('update','id'=>$model->id));
                        } else {
                            Yii::app()->user->setFlash('failure', "Data Not saved!");
                        }
                        
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if($model->save())  {
                            Yii::app()->user->setFlash('saved', "Data saved!");
  //                          $this->redirect(array('update','id'=>$model->id));
                        } else {
                            Yii::app()->user->setFlash('failure', "Data Not saved!");
                        }
                        
		}
                
                Yii::import( "xupload.models.XUploadForm" );
                $uploads = new XUploadForm;
		
		$photos=new Photo('search');
		$photos->unsetAttributes();  // clear any default values
		$photos->album_id=$id;
		
		$this->render('update',array(
			'model'=>$model,
                        'uploads'=>$uploads,
			'photos'=>$photos
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
	    	Yii::beginProfile('album.index');
		$dataProvider=new CActiveDataProvider('Album', array(
		    'criteria'=>array(
			'with'=>array('photos'),
		    )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		Yii::endProfile('album.index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Album('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 *Manage Image Uploads Using XUpload Extension
	 * $id: album_id 
	 */
	public function actionUpload($id) {
		Yii::import( "xupload.models.XUploadForm" );
		//Here we define the paths where the files will be stored temporarily
		$path = realpath( dirname(Yii::app()->request->scriptFile).Yii::app()->params['uploads'] ).DIRECTORY_SEPARATOR;
		$publicPath = Yii::app( )->getBaseUrl( ).Yii::app()->params['uploads']."/";
    
		//This is for IE which doens't handle 'Content-type: application/json' correctly
		header( 'Vary: Accept' );
		if( isset( $_SERVER['HTTP_ACCEPT'] ) 
		    && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
		    header( 'Content-type: application/json' );
		} else {
		    header( 'Content-type: text/plain' );
		}

		//Here we check if we are deleting and uploaded file
		if( isset( $_GET["_method"] ) ) {
		    if( $_GET["_method"] == "delete" ) {
			if( $_GET["file"][0] !== '.' ) {
			    $file = $_GET["file"];
			    if( is_file( $path.$file ) ) {
				$photo=Photo::model()->find('filename=:filename',array(':filename'=>$file));
				if ($photo) $photo->delete();
				unlink( $path.$file );
				unlink ($path."thumbs/".$file);
			    }
			}
			echo json_encode( true );
		    }
		} else {
		    $model = new XUploadForm;
		    $model->file = CUploadedFile::getInstance( $model, 'file' );
		    //We check that the file was successfully uploaded
		    if( $model->file !== null ) {
			//Grab some data
			$model->mime_type = $model->file->getType( );
			$model->size = $model->file->getSize( );
			$model->name = $model->file->getName( );
			//(optional) Generate a random name for our file
			$filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
			$filename .= ".".$model->file->getExtensionName( );
			if( $model->validate( ) ) {
			    //Move our file to our temporary dir
			    $model->file->saveAs( $path.$filename );
			    //chmod( $path.$filename, 0777 );
			    //here you can also generate the image versions you need 
			    //using something like PHPThumb

			    $image = Yii::app()->image->load($path.$filename);
			    $size=Yii::app()->params['thumbSize'] ;
			    $imd=$image->image;
			    $master=($imd['width'] > $imd['height']) ? 3 : 4;
			    $image->resize($size, $size,$master)->crop($size,$size)->quality(75)->sharpen(20);
			    $image->save($path."thumbs/".$filename, FALSE); 
                        
			    $photo=new Photo;
			    $photo->album_id=$id;
			    $photo->filename=$filename;
				if ($photo->save()) {
				//Now we need to tell our widget that the upload was succesfull
				//We do so, using the json structure defined in
				// https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
				echo json_encode( array( array(
					"name" => $model->name,
					"type" => $model->mime_type,
					"size" => $model->size,
					"url" => $publicPath.$filename,
					"thumbnail_url" => $publicPath."thumbs/$filename",
					"delete_url" => $this->createUrl( "upload", array(
					    "_method" => "delete",
					    "file" => $filename
					) ),
					"delete_type" => "POST"
				    ) ) );
				} else {
				    //If the upload failed for some reason we log some data and let the widget know
				    echo json_encode( array( 
					array( "error" => $model->getErrors( 'file' ),
				    ) ) );
				    Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
					CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
				    );
				}
			} else {
			    //If the upload failed for some reason we log some data and let the widget know
			    echo json_encode( array( 
				array( "error" => $model->getErrors( 'file' ),
			    ) ) );
			    Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
				CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
			    );
			}
		    } else {
			throw new CHttpException( 500, "Could not upload file" );
		    }
		}	    
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Album::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
