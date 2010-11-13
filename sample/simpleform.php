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
// PATH TO CONFIGURATION FILE								  //
# ------------------------------------------------------------ #

if ( !defined('CONFIG_PATH') )
	// path to config file from simpleform.php
	$PATH_TO_CONFIG_FILE = '';
// No need to edit under this line //////////////////////////////
else
	$PATH_TO_CONFIG_FILE = CONFIG_PATH;

define( 'CONFIG_FILE' , $PATH_TO_CONFIG_FILE . 'sf-config.php' );
if ( isset( $_POST['simpleform'] ) ) 
{
	$sForm = new simpleForm();
	$sForm->processData();
}

# ------------------------------------------------------------ #
// SIMPLEFORM CLASS      									  //
# ------------------------------------------------------------ #

class simpleForm
{
	private $aSettings = array();
	private $aForms    = array();
	private $aForm     = array();
	private $szContent, $szHeaders;
	
	public function __construct() 
	{
				
		global $aSettings;
		global $aForms;
		global $_POST;
		
		if ( file_exists( CONFIG_FILE ) ) 
			require_once ( CONFIG_FILE );
		else
			$bDebug = ( DEBUG_MODE ) ?  $this->debug( 'config' ) : false ;
		
		if ( empty( $aSettings ) || empty( $aForms ) ) 
			$bDebug = ( DEBUG_MODE ) ?  $this->debug( 'settings' ) : false ;
		
		$this->aSettings = $aSettings;
		$this->aForms 	 = $aForms;
						
	}
	
	public function handleMessage()
	{
		global $_GET;
		if ( isset( $_GET[GET_NAME] ) ) 
		$this->printMessage( $_GET[GET_NAME] );
	}
	
	private function printMessage( $iMessageNumber )
	{
		switch ( $iMessageNumber ) 
		{
			case 1:
				$szMessageType = "ok";
				$szMsg = $this->aSettings['aMessages']['szSubmitSucess'];
				$bDisplay  = true;
			break;

			case 2:
				$szMessageType = "error";
				$szMsg = $this->aSettings['aMessages']['szMissingFields'];
				$bDisplay  = true;
			break;

			case 3:
				$szMessageType = "error";
				$szMsg = $this->aSettings['aMessages']['szUnvalidEmail'];
				$bDisplay  = true;
			break;

			case 4:
				$szMessageType = "alert";
				$szMsg = $this->aSettings['aMessages']['szSystemError'];
				$bDisplay  = true;
			break;

			default:
				$bDisplay = false;
			break;
		}
		
		if ( $bDisplay == true ) 
			echo '<p class="message-box '.$szMessageType.'">'.$szMsg.'</p>';
	}
	
	public function printData( $iFormNumber )
	{
				
		if ( is_int( $iFormNumber ) && isset( $this->aForms[$iFormNumber] ) ) 
		{
			$this->aForm = $this->aForms[$iFormNumber];
			
			if ( !empty($this->aForm['szFormRequired']) )
			{
				$szReturn = "";		
				foreach ( $this->aForm['szFormRequired'] as $szName ) 
				{
					$szReturn .= "|".$szName."::".$this->aForm['aFormFields'][$szName];			
				}
				
				if ( $szReturn != "" ) 
				echo '<input type="hidden" name="validate" value="'.substr( $szReturn, 1, strlen($szReturn)).'" />'."\n";
			}			
			
			echo '<input type="hidden" name="simpleform" value="'.$iFormNumber.'" />'."\n";
			
		} else {
			$bDebug = ( DEBUG_MODE ) ? $this->debug( 'formnumber' ) : false;
		}
	}
	
	public function processData()
	{
		if ( !isset( $this->aForms[$_POST['simpleform']] ) )
		$this->quit('Form not found.');
		
		$this->aForm = $this->aForms[$_POST['simpleform']];
		
		$this->checkData();
		
		$this->generateContent();
		$this->declareHeaders();
		
		$this->sendEmail();
	}
		
	private function checkData()
	{
		if ( !empty($this->aForm['szFormRequired']) ) 
		{
			foreach ( $this->aForm['szFormRequired'] as $szKey ) 
			{
								
				if ( isset($_POST[$szKey]) && !is_array($_POST[$szKey]) && trim($_POST[$szKey]) == ""  ) 
				$this->alertResponce(2);
				
							
				$bIsEmail = strpos( $szKey, "email" );
				if ( $bIsEmail !== false  )
				{  
					
					if  ( $this->validEmail( $_POST[$szKey] ) == false ) $this->alertResponce(3);
				}
			}
		}
				
	}

	public function validEmail($email) 
	{
	   /*
	   validEmail
	   By Douglas Lovell
	   http://www.linuxjournal.com/article/9585 */
	 
	   $isValid = true;
	   $atIndex = strrpos($email, "@");
	   if (is_bool($atIndex) && !$atIndex)
	   {
	      $isValid = false;
	   }
	   else
	   {
	      $domain = substr($email, $atIndex+1);
	      $local = substr($email, 0, $atIndex);
	      $localLen = strlen($local);
	      $domainLen = strlen($domain);
	      if ($localLen < 1 || $localLen > 64)
	      {
	         $isValid = false;
	      }
	      else if ($domainLen < 1 || $domainLen > 255)
	      {
	         $isValid = false;
	      }
	      else if ($local[0] == '.' || $local[$localLen-1] == '.')
	      {
	         $isValid = false;
	      }
	      else if (preg_match('/\\.\\./', $local))
	      {
	         $isValid = false;
	      }
	      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
	      {
	         $isValid = false;
	      }
	      else if (preg_match('/\\.\\./', $domain))
	      {
	         $isValid = false;
	      }
	      else if
	(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
	                 str_replace("\\\\","",$local)))
	      {
	         if (!preg_match('/^"(\\\\"|[^"])+"$/',
	             str_replace("\\\\","",$local)))
	         {
	            $isValid = false;
	         }
	      }
	
			if (  defined('CHECK_EMAIL_ADDRESS_DNS') && CHECK_EMAIL_ADDRESS_DNS == true ) 
			{
				if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
				$isValid = false;
			}
	
	      
	   }
	   return $isValid;
	}
	
	private function generateContent()
	{
		$this->szContent  = $this->aSettings['szFrom'].': '.$this->aForm['szFormTitle']."\n";
		$szSeparador      = "------------------------------------------------------------\n\n"; 
		$this->szContent .= $szSeparador;
		$szLast = "";

		foreach( $this->aForm['aFormFields'] as $szValue => $szReal ) 
		{ 
			
			$szValue = str_replace('[]','', $szValue );
			
			if( isset($_POST[$szValue]) )
			{
				if( $szLast != $szReal )
				{
					$this->szContent .= $szReal.":";
					$szLast = $szReal;
				}; 
		        
				if ( is_array($_POST[$szValue]) ) 
				{
					foreach ( $_POST[$szValue] as $szSelected )
					$this->szContent .= "\n	* ".$szSelected;
					
					$this->szContent .= "\n\n";
				} else {
                	$this->szContent .= " ".$_POST[$szValue]."\n\n"; 
				}
		
			}
			else if ( $szValue{0} == "-" )
			{
				$this->szContent .= "\n\n".$szReal."\n";
				$this->szContent .= $szSeparador;
				$szLast = $szReal; 
			};
		};
		
		$bDebug = ( DEBUG_MODE ) ?  die(nl2br( $this->szContent )) : false ;


	}
	
	private function declareHeaders()
	{
		$this->szHeaders  = 'From: ' .  $this->aSettings['szFromEmail'] . "\r\n";
		$this->szHeaders .= 'Reply-To: ' . $this->aSettings['szFromEmail'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	}
	
	private function sendEmail()
	{
		if( mail( $this->aSettings['szRecipient'], $this->aSettings['szFromEmail'].': '.$this->aForm['szFormTitle'], $this->szContent, $this->szHeaders, '-f' . $this->aSettings['szFromEmail'] ) )  
		{
			$this->alertResponce(1);
		}
		else  
		{    
		   $this->alertResponce(4);
		};
	}
	
	private function alertResponce( $iMessageNumber  )
	{
		header( "location: ".$this->aForm['szFormURL']."?".GET_NAME."=".$iMessageNumber ); 
		die();
	}
	
	private function debug( $szCase )
	{
		switch ( $szCase ) 
		{
			case "config":
				$szMessageType = "error";
				$szMsg = "SimpleForm config file missing.";
				$bDisplay  = true;
			break;
			
			case "settings":
				$szMessageType = "error";
				$szMsg = "Missing SimpleForm configuration values. Please check your settings.";
				$bDisplay  = true;
			break;

			case "formnumber":
				$szMessageType = "error";
				$szMsg = "The form requested can't be found.";
				$bDisplay  = true;
			break;

			default:
				$bDisplay = false;
			break;
		}
		
		if ( $bDisplay == true ) 
			echo '<p class="message-box '.$szMessageType.'">'.$szMsg.'</p>';
	}
	
	private function quit( $szMessage )
	{
		$szMessage = '<p><strong>Error:</strong> '.$szMessage.'</p>';
		die( $szMessage );
	}
	
}
?>