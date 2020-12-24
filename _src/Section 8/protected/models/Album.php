<?php

/**
 * This is the model class for table "tbl_album".
 *
 * The followings are the available columns in table 'tbl_album':
 * @property integer $id
 * @property string $name
 * @property string $tags
 * @property integer $owner_id
 * @property integer $shareable
 * @property string $created_dt
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property Photo[] $photos
 */
class Album extends CActiveRecord
{
	private $_oldTags; 
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, shareable, category_id', 'numerical', 'integerOnly'=>true),
			array('name, tags', 'length', 'max'=>255),
                        array('description','length', 'max'=>1024),
                        array('description', 'match', 'pattern'=>'/[\w]+/u'), // \-\_\'\ \,\p{L}0-9
                        
			array('category_id', 'checkCategory'), 
		    
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, tags, owner_id, shareable, created_dt', 'safe', 'on'=>'search'),
		);
	}
	/**
	 * Custom validation for category_id
	 * Validate that it exists in Options table
	 * @param type $attribute
	 * @param type $params
	 * @return boolean 
	 */
	public function checkCategory($attribute,$params)
        {
            if (empty($this->$attribute)) 
                return true;

            $command=Yii::app()->db->createCommand("Select * from tbl_option where option_name='CATEGORY' and id=:opvalue");
            $command->bindValue(':opvalue',$this->$attribute,PDO::PARAM_STR);
            $result=$command->queryRow();
            if (($result))
                    return true;
            else 
                $this->addError($attribute,"Invalid Category - Please select a known category"); 
        }
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
            if(parent::beforeSave()) {
                if($this->isNewRecord) {
                    $this->created_dt=new CDbExpression("NOW()");
                    $this->owner_id=Yii::app()->user->id;
                }
                return true;
            }
            else
                return false;	
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
			'photos' => array(self::HAS_MANY, 'Photo', 'album_id'),
			'categories'=>array(self::BELONGS_TO, 'Option', 'category_id', 'on' => 'option_name=\'CATEGORY\'',), 
		    );
	}
        
        public function scopes()
        {
                return array(
                    'mine'=>array(
			'order'=>'created_dt DESC',
			'condition'=>'owner_id=:owner',
			'params'=>array(
			    'owner'=>Yii::app()->user->id,
                        ),
                    ),
		    'shareable'=>array(
                        'order'=>'created_dt DESC',
                        'condition'=>'shareable=1',
                        )
                );
                //$album=Album::$model()->shareable()->findAll();
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'tags' => 'Tags',
			'owner_id' => 'Owner',
			'category_id' => 'Catgeory',
                        'description' => 'Description',
                        'shareable' => 'Shareable',
			'created_dt' => 'created Dt',
		);
	}
/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('album/search', 'tag'=>$tag),array('class'=>'btn btn-small'));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}


	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
	}

	
	/**
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		Tag::model()->updateFrequency($this->_oldTags, $this->tags);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		Comment::model()->deleteAll('album_id='.$this->id);
		Tag::model()->updateFrequency($this->tags, '');
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('tags',$this->tags,true);
	        $criteria->compare('description',$this->description);
		
		$criteria->scopes='mine';
            
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
                
}