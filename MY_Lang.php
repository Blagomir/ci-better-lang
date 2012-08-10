<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @name ci-better-lang - trying to be a better translation library for CodeIgniter
 * @author Blagomir Ivanov < blagomir.ivanov@gmail.com >
 * @version 1.0
 */

class MY_Lang extends CI_Lang {

	/**
	 * Translate phrases with given parameters
	 *
	 * @param char $phrase - phrase to be translated
	 * @param array $vars - variables (markers) to be replaced in $phrase
	 * @param string $lang - force translation to $lang language
	 * @return string - translated phrase
	 */
	function phrase($phrase, $vars=NULL, $lang=NULL)
	{
		/**
		 * We don`t need empty phrases in our translation
		 */
		if ( !is_string($phrase) || empty($phrase) )
		{
			return $phrase;
		}

		/**
		 * If we have set a different language, we have to load the translation file
		 * 
		 * This library presumes that all your translations are in one file.
		 * e.g.: English is in application/language/english/english.php
		 * e.g.: French is in application/language/french/french.php
		 */
		if (isset($lang))
		{
			$this->load($lang, $lang);
		}		
		
		/**
		 * We are trying to find the translated phrase.
		 */
		if ($this->line($phrase) === FALSE)
		{
			$translated = $phrase;
			/**
			 * We now know that our phrase is missing in the translation file.
			 * We can add it to a database for translation or whatever you prefer to do with the prase
			 */
			
			//
			// Some code here to handle the missing phrase
			//
			
			/**
			 * We are also adding this phrase in the $lang array if we need it somewhere else with the same request.
			 */
			$lang[$phrase] = $phrase;
		}
		else
		{
			$translated = $this->line($phrase);
		}

		/**
		 * If we have passed the array with markers, we replace them in the original phrase
		 */
		if( isset($vars) )
		{
			$translated = strtr($translated, $vars);
		}		

		
		return $translated;
		
	}
	
}

/* End of file */
