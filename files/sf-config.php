<?php
/* 

SIMPLE FORM SCRIPT ver 1.1.4
Copyright (c) 2009, Matt Varone
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Matt Varone nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

http://www.mattvarone.com */

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