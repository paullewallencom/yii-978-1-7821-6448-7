<?php

class UserTest extends MyTestCase {
    
    private function getUser($userid) {
        $user=User::model()->findByPk($userid);
        return $user->fullName();
    }
    
    function testFullName() {
        $this->assertEquals('Admin Root', $this->getUser(2));
        $this->assertEquals('Fred', $this->getUser(3));
        $this->assertEquals('Smith', $this->getUser(4));
                
    }
    
    function testSearch() {
        $users = $this->getTableArray('Select * from tbl_user where email like "%user%"','email');
        
        $mUser=new User('Search');
        $mUser->email='user';
        $mUserData=$mUser->search()->getData();
        $mUsers=$this->getModelArray($mUserData,'email');
        
        $this->assertEquals($users, $mUsers);
    }
}