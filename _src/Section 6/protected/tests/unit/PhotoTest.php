<?php

class PhotoTest extends CDbTestCase 
{
    public $fixtures=array(
        'photos' => 'Photo',
    );

    private $photo_id;

    public static function setUpBeforeClass() {
    }
  
    function setup() {
        parent::setUp();
        $_POST['Photo']['album_id']=1;
        $_POST['Photo']['filename']="IMG_1234.jpg";
        $_POST['Photo']['caption']="This is a photo caption" ;
        $_POST['Photo']['alt_text']="This is some alt text";
        $_POST['Photo']['tags']="Tag1,Tag2,Tag3";
        $_POST['Photo']['sort_order']=1;
    }
    
    public function testInsert() {
        $photo=new Photo;
        $photo->attributes=$_POST['Photo'];
	if ($photo->save()) {
                $this->photo_id=$photo->id;
                $this->assertEquals($_POST['Photo'],$photo->attributes);
        }
    }
    
    function tearDown() {
        if ($this->photo_id) {
            $photo=Photo::model()->findByPk($this->photo_id)->delete();
        }
    }

    
    public static function tearDownAfterClass() {
    }
}    