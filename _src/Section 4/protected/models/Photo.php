<?php

/**
 * This is the model class for table "tbl_photo".
 *
 * The followings are the available columns in table 'tbl_photo':
 * @property integer $id
 * @property integer $album_id
 * @property string $filename
 * @property string $caption
 * @property string $alt_text
 * @property string $tags
 * @property integer $sort_order
 * @property string $created_dt
 * @property string $lastupdate_dt
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Album $album
 */
class Photo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photo the static model class
	 */

        private $_uploads;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album_id, sort_order', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>500),
			array('tags', 'length', 'max'=>256),
			array('caption, alt_text, created_dt, lastupdate_dt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, album_id, filename, caption, alt_text, tags, sort_order, created_dt, lastupdate_dt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'photo_id'),
			'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
                   	'commentCount' => array(self::STAT , 'Comment', 'photo_id', 'condition'=>'status='.Comment::STATUS_APPROVED), 
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'album_id' => 'Album',
			'filename' => 'Filename',
			'caption' => 'Caption',
			'alt_text' => 'Alt Text',
			'tags' => 'Tags',
			'sort_order' => 'Sort Order',
			'created_dt' => 'Created Dt',
			'lastupdate_dt' => 'Lastupdate Dt',
		);
	}
        public function getImageParam() {
            if (empty($this->_uploads))
                $this->_uploads=Yii::app()->params['uploads']."/";
            return $this->_uploads;
        }
        public function getUrl() {
            return $this->getImageParam().CHtml::encode($this->filename);
        }
        public function getThumb() {
            return $this->getImageParam()."thumbs/".CHtml::encode($this->filename);
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

		$criteria->compare('id',$this->id);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('alt_text',$this->alt_text,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('lastupdate_dt',$this->lastupdate_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
}