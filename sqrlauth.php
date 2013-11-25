









<?php

/**
* Process SQRL logins.
* 
* Documentation of the SQRL protocol is available at https://www.grc.com/sqrl/sqrl.htm
*
* @copyright	Copyright Simon Wilkinson (Madfish) 2013
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Simon Wilkinson (Madfish) <simon@isengard.biz>
* @package		login
* @version		$Id$
*/

include_once "header.php";
$xoopsOption["template_main"] = "login_key.html";
include_once ICMS_ROOT_PATH . "/header.php";

////////////////////////////////////////////////////////////
//////////////////// Process SQRL login ////////////////////
////////////////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Verify that mandatory parameters have been supplied, exit if incomplete (no warnings)
	if (!isset($_POST['sqrlkey']) && strlen($_POST['sqrlkey'] == 43)
			|| !isset($_POST['sqrlsig']) 
			|| !isset($_POST['sqrlver'])) {
		exit();
	}

	// Whitelist authorised paramters
	$allowed_vars = array(
		'sqrlver' => 'int', // SQRL protocol version. Mandatory
		'sqrlkey' => 'plaintext', // User's public key, must be exactly 43 ASCII characters. Mandatory
		'sqrlsig' => 'plaintext', // Signature of the challenge signed with user's private key, converted to ASCII. Mandatory.
		'sqrlopt' => 'plaintext', // Optional parameters, currently 'enforce' is the only one available.
		'sqrlold' => 'plaintext', // Retired public key that should no longer be used (43 ASCII characters). Optional.
		'sqrlpri' => 'plaintext' // Signature generated by retired public key the user wishes to revoke, converted to ASCII. Optional.
	);
	
	// Sanitise user data

	// Verify signature

} else {
	////////////////////////////////////////////////////////////////
	//////////////////// Display SQRL challenge ////////////////////
	////////////////////////////////////////////////////////////////
	echo '<img src="' . ICMS_URL . '/modules/login/include/sqrl.php" />';
}

include_once "footer.php";