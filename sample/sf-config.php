<?php
/* 

SIMPLE FORM SCRIPT ver 1.1.4
Copyright (c) 2009, Matt Varone
All rights reserved.
License: GPL2

# ------------------------------------------------------------ #
// SIMPLEFORM CONFIGURATION								      //
# ------------------------------------------------------------ #

/* GENERAL CONFIGURATION
/////////////////////////////*/

// The name of the website/client. Example: "My Website".
$aSettings["szFrom"] = "My Website";						

// The email address that will receive the emails. Example: "me@myemail.com".
$aSettings["szRecipient"] = "me@mywebsite.com";	

/* The email address that will be used to send the emails. To work properly this has to be a real account
configured on the same server of the site. Example: "noreply@mywebsite.com". */
$aSettings["szFromEmail"] = "noreply@mywebsite.co";					    

/* FORMS CONFIGURATION
/////////////////////////////*/

/* The next step is to configure the Form/s. 
   You can add as many as you want. */

$aForms = array(

	1 => array( 											// FORM ID
		"szFormTitle" => "Main Contact Form", 				// FORM TITLE
		"szFormURL" => "index.php",							// FORM URL ( users will be redirected to this page )
		"szFormRequired" => array(							/* REQUIRED FIELDS ( array of name attributes ) */
			"email",
			"phone",
			"color",
			"newsletter",
			"interested[]",
		),  
		"aFormFields" => array( 							/* LIST OF FORM FIELDS AND THEIR OUTPUT NAME
 													   		All input fields coming from the form should go here.
													   		The first value is the name attribute used and the second value
													   		on the right the name displayed on the outputed data.
															
															Any required field that contains the word "email" will have 
															its value validated as an email address. */
		   	"name" => "First Name",					  
			"email" => "E-mail",						
			"work_email" => "Work Email",					
			"phone" => "Telephone",
			"-sep1" => "This is a separator",					// This is a separator. Any variable starting with the sign "-" will act as a content separator.
			"color" => "Color Option",
			"comments" => "Comments",
			"-sep2" => "This is Another separator",
			"newsletter" => "Subscribe to our Newsletter?",
			"interested[]" => "Im interested in",
			/* add more */
			)
	),
	
2 => array(										
	"szFormTitle" => "Orders Form",
	"szFormRequired" => array("pname","pemail","size"),
	"szFormURL" => "multiple.php",
	"aFormFields" => array( 
		"pname" => "Product Name",
		"pemail" => "Email",
		"pphone" => "Telephone",
		"size" => "Size Selected",
		)
),
);

/* RESPONSE CONFIGURATION
/////////////////////////////*/

/* Response Messages: These are the variables that hold the messages 
the system prints as response. You can modify them to suit your project needs. */

$aSettings["aMessages"]["szSubmitSucess"]  = "Your message has been sent succesfully. Thanks!";
$aSettings["aMessages"]["szMissingFields"] = "Please complete all required fields.";
$aSettings["aMessages"]["szUnvalidEmail"]  = "Please insert a valid email address.";
$aSettings["aMessages"]["szSystemError"]   = "There was an error in the system. Please try again later. Thanks!";

/* ADVANCED CONFIGURATION
/////////////////////////////*/

define( "GET_NAME", "response");
define( "DEBUG_MODE" , false );
define( "CHECK_EMAIL_ADDRESS_DNS" , false ); 
?>