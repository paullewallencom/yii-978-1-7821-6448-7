<?php
class PhotoTest extends WebTestCase {

    function testIndex() {
        $this->open("photo");
        $this->assertTextPresent('Photos');
        
        $this->verifyElementPresent('css=div.view');
        
        $this->click("css=a[href='/uploads/IMG_1152.jpg']");
	$this->verifyElementPresent('id=cboxLoadedContent');

    }
    
    function testAdmin() {
        $this->open("photo/admin");

        $this->type('name=LoginForm[username]','Admin');
        $this->type('name=LoginForm[password]','admin');
        $this->clickAndWait("//input[@value='Login']");

        $this->assertTextPresent('IMG_1134.jpg');

        $this->click("css=a[href='/photo/admin?Photo_sort=caption']");
        $this->waitForEval ("window.document.querySelectorAll('div.keys span')[0].textContent", "3" ); //storeText("css=div.keys");
            
        $this->clickAndWait("css=a[href='/photo/update/3']");
        $this->type('name=Photo[sort_order]','xxx');
	$this->clickAndWait("//input[@value='Save']");
        $this->verifyTextPresent('Sort Order must be an integer.');
        
	$this->type('name=Photo[sort_order]','3');
	$this->clickAndWait("//input[@value='Save']");
        $this->verifyTextPresent('View Photo #3');
        
    }
}