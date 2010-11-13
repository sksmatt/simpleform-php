<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SimpleForm Multiple Form Example</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	
	<link rel="stylesheet" href="simpleform.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="checkform.mini.js"></script>
</head>

<body>

	<?php
	define('CONFIG_PATH', '');
	require_once "simpleform.php";
	$sForm = new simpleForm();
	
	$sForm->handleMessage();
	?>
		
		
	<form action="simpleform.php" method="post" onsubmit="return checkform(this)">  
	<fieldset>
	<?php $sForm->printData(1); ?>
		<legend>Personal Details:</legend>
        <label for="name" >Name</label>
        <input name="name" id="name" type="text" value="" />
        <label for="email">Email <span class="required">(required)</span></label>
        <input name="email" id="email" type="text" value="" />
		<label for="work_email">Work Email</label>
        <input name="work_email" id="work_email" type="text" value="" />
		<label for="phone">Telephone <span class="required">(required)</span></label>
        <input name="phone" id="phone" type="text" value="" />
        <label for="color">Color Options: <span class="required">(required)</span></label>
        <select name="color" id="color">
			<option value="-">Choose a color</option>
			<option value="Red">Red</option>
			<option value="Green">Green</option>
			<option value="Blue">Blue</option>
		</select>
        <label for="comments">Comments</label>
        <textarea name="comments" id="comments" rows="10" cols="50"></textarea>
        </fieldset>
        <fieldset class="radio">
            <legend>Subscribe to our Newsletter? <span class="required">(required)</span></legend>
            <label><input type="radio" name="newsletter" value="Yes" /> Yes</label>
            <label><input type="radio" name="newsletter" value="No" /> No</label>
        </fieldset>
		<fieldset class="checkbox">
            <legend>I'm interested in: <span class="required">(required)</span></legend>
            <label><input type="checkbox" name="interested[]" value="Arts" /> Arts</label>
			<label><input type="checkbox" name="interested[]" value="Science" /> Science</label>
			<label><input type="checkbox" name="interested[]" value="Sports" /> Sports</label>
        </fieldset>

        <p><button type="submit">Submit this!</button></p>
    </form>


	<form action="simpleform.php" method="post" onsubmit="return checkform(this)"> 
	<fieldset>
	<?php $sForm->printData(2); ?>
		<legend>Order Details:</legend>
        <label for="pname" >Product Name <span class="required">(required)</span></label>
        <input name="pname" id="pname" type="text" value="" />
        <label for="pemail">Email <span class="required">(required)</span></label>
        <input name="pemail" id="pemail" type="text" value="" />
		<label for="pphone">Telephone</label>
        <input name="pphone" id="pphone" type="text" value="" />
        <label for="size">Size Options: <span class="required">(required)</span></label>
        <select name="size" id="size">
			<option value="-">Choose a size</option>
			<option value="small">small</option>
			<option value="medium">medium</option>
			<option value="large">large</option>
		</select>
	</fieldset>
        <p><button type="submit">Submit this!</button></p>
    </form>
   
</body>
</html>