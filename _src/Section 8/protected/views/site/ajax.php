
<?php 
/**CB-7.5**/
/** 
 *  Section 7.5 - AJAX error response test
 */
Yii::app()->clientScript->registerScript('getdata', '

 // onButtonClick; use jQuery get and specify an invalid URL
 // then use deferred method to check completion
 // on Fail, decode the JSON response and then call
 // error function to display the error
 
 $(".clickHere").live("click",function () {
	var jqxhr =$.get("/album/view/99")
	.done(function(data) { $("#result").html(data); })
	.fail(function() { 
		result = JSON.parse(jqxhr.responseText);
		showError(result);
	});
    });
    
   function showError(result) {
    if (result.result === 0) {
	errorPopupHtml =  result.error.type+" Error: "+result.error.message;
	alert(errorPopupHtml);
	}
    }
');

echo CHtml::button("Click Here", array('class'=>"clickHere"))
?>
<div id="result"></div>