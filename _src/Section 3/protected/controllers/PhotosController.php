<?php

class PhotoController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','sort'),
				'users'=>array('@'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        public function actionSort() {
            if (isset($_POST['items']) && is_array($_POST['items'])) {
                // Get all current target items to retrieve available sortOrders
                $cur_items = Photo::model()->findAllByPk($_POST['items'], array('order'=>'sort_order'));
                // Check 1 by 1 and update if neccessary
                for ($i = 0; $i < count($_POST['items']); $i++) {
                    $item = Photo::model()->findByPk($_POST['items'][$i]);
                    if ($item->sort_order != $cur_items[$i]->sort_order) {
                        $item->sort_order = $cur_items[$i]->sort_order ;
                        $item->save();
                    }
                }
            }
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Photo;
                // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                fb($_POST,'Application.Photo.Create.POST');
                    
		if(isset($_POST['Photo']))
		{
                    $model->attributes=$_POST['Photo'];
                    $myfile = CUploadedFile::getInstance($model,'image');
                    $model->image=$myfile;
                          
                    if($model->save())
                       //fb( $myfile->name,'Application.Photo.Create.IMAGE_CLASS');
                        $this->updatePhoto($model, $myfile);
                        echo CHtml::script(" $('#Photouccess').html('<p class=\"Error\">ERROR: Error saving photo.  Please check log files for further information.</p>');");
                            
                        //----- begin new code --------------------
                        if (!empty($_GET['asDialog']))
                        {
                            //Close the dialog, reset the iframe and update the grid
                            echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}'); return false;");
                            Yii::app()->end();
                        }
                }
                if(!empty($_GET['pid']))
                    $model->property_id=$_GET['pid'];
                
		if (!empty($_GET['asDialog']))
                    $this->layout = '//layouts/iframe';
                
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

		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
			$myfile = CUploadedFile::getInstance($model,'image');
                        $model->image=$myfile;
                        if($model->save())
                       
                            $this->updatePhoto($model, $myfile);
                            echo CHtml::script(" $('#Photouccess').html('<p class=\"Error\">ERROR: Error saving photo.  Please check log files for further information.</p>');");
                            
                        //----- begin new code --------------------
                        if (!empty($_GET['asDialog']))
                        {
                            //Close the dialog, reset the iframe and update the grid
                            echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                            Yii::app()->end();
                        }
                }
                if(!empty($_GET['pid']))
                    $model->property_id=$_GET['pid'];
                
		if (!empty($_GET['asDialog']))
                    $this->layout = '//layouts/iframe';
                
                $this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
  		if(Yii::app()->request->isPostRequest)
		{
                    // we only allow deletion via POST request
                    //$this->loadModel($id)->delete();
                
                    $Photo=Photo::model()->FindByPk($id);
                    $pid=$Photo->property_id;

                    if (!is_null($Photo->filename) && $Photo->filename!='') {
                        $old = getcwd(); // Save the current directory

                        chdir($Photo->getPath(false));
                        if (file_exists( $Photo->filename )) {
                            fb('Deleting -->'.$Photo->filename);
                            unlink ( "$Photo->filename" );
                        }

                        //fb('DeletingThumb -->'.$Photo->getThumb(false)."~".$Photo->filename);
                        chdir('thumbs'); //$Photo->getThumb(false));
                        if (file_exists( $Photo->filename )) {
                            fb('DeletingThumb -->'.$Photo->filename);
                            unlink ( "$Photo->filename" );
                        }

                        chdir($old);
                    }
                    $Photo->delete();

                    echo "success";
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    //$this->redirect("/properties/update?id=$pid&tab=3");
                }
	}
 
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Photo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Photo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Photo']))
			$model->attributes=$_GET['Photo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        /*------------------------------------------------------------------------------------------------------
         * 
         */
        public function updatePhoto($model, $myfile ) {
            //$myfile = CUploadedFile::getInstance($model,'image');
           //fb($myfile,"Model Saved - image attached?");
           if (is_object($myfile) && get_class($myfile)==='CUploadedFile') {
                //fb('myfile is uploadfile');
                $ext = $model->image->getExtensionName();

                if ($model->filename=='' or is_null($model->filename)) {
                    $n=1;
                    // loop until random is unqiue - which it probably is first time!
                    while ($n>0) {
                        $rnd=dechex(rand()%999999999);
                        $filename=$model->property->ref . '_' . $rnd . '.' . $ext;
                        $n=Photo::model()->count('filename=:filename',array('filename'=>$filename));
                    }
                $model->filename=$filename;
                }

                //$model->image = $myfile;
                //$model->filename->saveAs('path/to/localFile');
                //fb($model->filename);
                $model->save();

                $model->image->saveAs($model->getPath());

                $image = Yii::app()->image->load($model->getPath());
                $size=$this->getOption('PhotoLarge');
                //fb($size);
                $image->resize($size[0], $size[0])->quality(75)->sharpen(20);
                $image->save(); // or $image->save('images/small.jpg');
                // redirect to success page

                //$thumb=$path . $this->_PathSep . "thumbs" . $this->_PathSep . $model->filename; 
                //fb($thumb);
                $size=$this->getOption('PhotoThumb');
                $image->resize($size[0], $size[0])->quality(75)->sharpen(20);
                $image->save($model->getThumb()); // or $image->save('images/small.jpg');
                return true;
                //Yii::app()->user->setFlash('success',
             } else return false;
        }
	public function getOption($column) {

                $Sql ="SELECT option_value FROM options WHERE option_name='$column' ORDER BY option_value";
                $command =Yii::app()->db->createCommand($Sql);
                $res =$command->queryColumn();

                return $res;
                
         }
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Photo::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
