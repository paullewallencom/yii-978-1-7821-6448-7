/**
Copyright: Packt Publishing
Create By: Chris Backhouse - SudWebDesign
Created Date: 04.03.2013
Description:  This README file is to accompany code downloads for Section 3 of the 
Video Series "Beginning Yii" from Packt Publishing.
**/

This zip file is for use at the beginning of Section 3 and contains all the code
up to the end of Section 2.

EITHER

Copy all these files into your project directory and over-write your entire Project.

But don't worry ...

The Protected/Config/main.php has been renamed so as not to over-write your 
configuration file.  If you wish to use this copy to run a fresh install, 
then you will need to rename Protected/Config/main-original.php to main.php

Also, in the www directory you would need to rename index-original.php to index.php

OR ...

From the source code for this section, we need to copy the 
protected/components/UserIdentity.php class and over-write the current file.  
This enables database authentication of Users and we will 
examine this in detail in Section 6.4 and 6.5

Secondly, we need to copy in the new theme files as we did last time by copying 
www/themes/photoGal and over-writing those in your Porject directory

PLUS ...

Lastly, we need to change our Album table.  You can find the SQL in the downloaded 
code for this section within protected/data/section2.3.sql  Run this against your 
database to add 2 new columns to the albums table, description and category 
and it also adds some data to the option table.  

The descriptions is a simple text field.  
The category will be a lookup against the option table which we'll be using in Section 8.
