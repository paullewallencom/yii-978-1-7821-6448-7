<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

/**
 * Description of newSeleneseTest
 *
 * @author chris
 */
class newSeleneseTest extends PHPUnit_Extensions_SeleniumTestCase {

    function setUp() {
        $this->setBrowser("*firefox  E:/ProgramFilesx86/Mozilla-Firefox/firefox.exe");
        $this->setBrowserUrl("http://photogallery.lan/");
    }

    function testMyTestCase() {
        $this->open("/");
        $this->assertTextPresent('Welcome');
        
        $this->open('/site/contact');
        $this->assertTextPresent('Contact Us');
        $this->assertElementPresent('name=ContactForm[name]');

        // test login process, including validation
		$this->clickAndWait('link=Login');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','demo');
		$this->click("//input[@value='Login']");
		$this->waitForTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','demo');
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextNotPresent('Password cannot be blank.');
		
		
    }

}

?>