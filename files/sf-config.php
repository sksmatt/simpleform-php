<?php
/* 

SIMPLE FORM SCRIPT ver 1.1.4
Copyright (c) 2009, Matt Varone
License: GPL2

*/

# ------------------------------------------------------------ #
// SIMPLEFORM CONFIGURATION								      //
# ------------------------------------------------------------ #

/* GENERAL CONFIGURATION
/////////////////////////////*/

// The name of the website/client. Example: "My Website".
$aSettings["szFrom"] = "";							

// The email address that will receive the emails. Example: "me@myemail.com".
$aSettings["szRecipient"] = "";		

/* The email address that will be used to send the emails. To work properly this has to be a real account
configured on the same server of the site. Example: "noreply@mywebsite.com". */
$aSettings["szFromEmail"] = "";					    

/* FORMS CONFIGURATION
/////////////////////////////*/

/* The next step is to configure the Form/s. 
   You can add as many as you want. */

$aForms = array(
	
	1 => array( 									// FORM ID: 1
		"szFormTitle" => "",						// FORM TITLE - Example: "Contact Form"
		"szFormURL" => "",							// FORM URL ( users will be redirected to this page )
		"szFormRequired" => array(					/* REQUIRED FIELDS ( array of name attributes ) */
			"name",	// examples	
			"email", 	
		),				
		"aFormFields" => array( 				
		   	"" => "First Name", 	// examples					  
			"email" => "E-mail",						
			"work_email" => "Work Email",					
			"phone" => "Telephone",
			"-sep1" => "This is a separator",		/* This is a separator. Any variable starting with the sign "-" 
														will act as a content separator. */
			"color" => "Color Option",
			"comments" => "Comments",
			"-sep2" => "This is Another separator",
			"newsletter" => "Subscribe to our Newsletter?",
			"interested[]" => "Im interested in",
			/* add more */
			)
	),
	
	2 => array(										/* Form 2. Same as above */
		"szFormTitle" => "",
		"szFormRequired" => array(),
		"szFormURL" => "",
		"aFormFields" => array( 
			/* add more */
			)
	),

	3 => array(										/* Form 3. Same as above */
		"szFormTitle" => "",
		"szFormRequired" => array(),
		"szFormURL" => "",
		"aFormFields" => array( 
			/* add more */
			)
		),
	
	/* add more */
);

/* RESPONSE CONFIGURATION
/////////////////////////////*/

/* Response Messages: These are the variables that hold the messages 
the system prints as response. You can modify them to suit your project needs. */

 // Form has been sent.
$aSettings["aMessages"]["szSubmitSucess"]  = "Your message has been sent succesfully. Thanks!";
// Missing fields.
$aSettings["aMessages"]["szMissingFields"] = "Please complete all required fields.";
// Unvalid email address. 
$aSettings["aMessages"]["szUnvalidEmail"]  = "Please insert a valid email address.";
// Email not sent by system error.
$aSettings["aMessages"]["szSystemError"]   = "There was an error in the system. Please try again later. Thanks!";

/* ADVANCED CONFIGURATION
/////////////////////////////*/

// Name of the GET variable to pass response messages
define( "GET_NAME", "response");
// Debug mode ( prints email content, and system errors )
define( "DEBUG_MODE" , false );
/* Check if the domain of the submited email addresses exists. 
False by default as it may bring problems with some servers. ) */
define( "CHECK_EMAIL_ADDRESS_DNS" , false ); 
?>