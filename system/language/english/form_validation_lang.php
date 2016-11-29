<?php
			if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {

$lang['required']			= "This %s field is required.";
$lang['isset']				= "This %s field must have a value.";
$lang['valid_email']		= "Please enter the same value again.";
$lang['valid_emails']		= "This %s field must contain all valid email addresses.";
$lang['valid_url']			= "This %s field must contain a valid URL.";
$lang['valid_ip']			= "This %s field must contain a valid IP.";
$lang['min_length']			= "This %s field must be at least %s characters in length.";
$lang['max_length']			= "This %s field can not exceed %s characters in length.";
$lang['exact_length']		= "This %s field must be exactly %s characters in length.";
$lang['alpha']				= "This %s field may only contain alphabetical characters.";
$lang['alpha_numeric']		= "This %s field may only contain alpha-numeric characters.";
$lang['alpha_dash']			= "This %s field may only contain alpha-numeric characters, underscores, and dashes.";
$lang['numeric']			= "This %s field must contain only numbers.";
$lang['is_numeric']			= "This %s field must contain only numeric characters.";
$lang['integer']			= "This %s field must contain an integer.";
$lang['regex_match']		= "This %s field is not in the correct format.";
$lang['matches']			= "This %s field does not match the %s field.";
$lang['is_unique'] 			= "%s already taken";
$lang['is_natural']			= "This %s field must contain only positive numbers.";
$lang['is_natural_no_zero']	= "This %s field must contain a number greater than zero.";
$lang['decimal']			= "This %s field must contain a decimal number.";
$lang['less_than']			= "This %s field must contain a number less than %s.";
$lang['greater_than']		= "This %s field must contain a number greater than %s.";

			} else {

$lang['required']			= "Il campo %s è obbligatorio.";
$lang['isset']				= "Il campo %s deve contenere un valore.";
$lang['valid_email']		= "Inserisci lo stesso valore come sopra.";
$lang['valid_emails']		= "Il campo %s deve contenere email valide.";
$lang['valid_url']			= "Il campo %s deve contenere un URL valido.";
$lang['valid_ip']			= "Il campo %s deve contenere un IP valido.";
$lang['min_length']			= "Il campo %s deve contenere minimo %s caratteri.";
$lang['max_length']			= "Il campo %s deve contenere massimo %s caratteri.";
$lang['exact_length']		= "Il campo %s deve contenere esattamente %s caratteri.";
$lang['alpha']				= "Il campo %s può contenere solo lettere.";
$lang['alpha_numeric']		= "Il campo %s può contenere solo lettere e numeri.";
$lang['alpha_dash']			= "Il campo %s può contenere solo lettere, numeri, underscores (_) e punti.";
$lang['numeric']			= "Il campo %s deve contenere solo numeri.";
$lang['is_numeric']			= "Il campo %s deve contenere solo caratteri numerici.";
$lang['integer']			= "Il campo %s deve contenere un numero intero.";
$lang['regex_match']		= "Il campo %s non è nel formato corretto.";
$lang['matches']			= "Il campo %s non coincide con il campo %s.";
$lang['is_unique'] 			= "%s già in uso.";
$lang['is_natural']			= "Il campo %s deve contenere solo numeri positivi.";
$lang['is_natural_no_zero']	= "Il campo %s fdeve contenere un numero maggiore di zero.";
$lang['decimal']			= "Il campo %s deve contenere un numero decimale.";
$lang['less_than']			= "Il campo %s deve contenere un numero inferiore a %s.";
$lang['greater_than']		= "Il campo %s deve contenere un numero maggiore di %s.";

			}

/* End of file form_validation_lang.php */
/* Location: ./system/language/english/form_validation_lang.php */