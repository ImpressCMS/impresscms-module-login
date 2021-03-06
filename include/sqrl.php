<?php

/**
 * Secure QR Login generator
 *
 * This file holds the functions driving the Secure QR Login display
 *
 * @copyright	Isengard.biz
 * @license		GNU General Public License V2 or higher version http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @author		Simon Wilkinson (Madfish)
 * @since		1.0
 * @package		Login
 * @version		$Id$
 */

// Include QR code library (must support at least version 13, which can hold 259 alpha-numeric 
// characters with high quality error correction)
include "phpqrcode/qrlib.php";

// Generate a QR code containing i) the site URL for processing SQRL and ii) a nonce
$nonce = '';
if(function_exists('openssl_random_pseudo_bytes')) {
	$nonce = base64_encode(openssl_random_pseudo_bytes(128, $strong));
	if($strong == TRUE) {
		// Need to truncate the result as base64 is about 1/3rd longer
		$nonce = substr($nonce, 0, 128);
	} else {
		echo _MB_LOGIN_WEAK_ALGORITHM_ERROR;
		exit;
	}
} else {
	echo _MB_LOGIN_OPEN_SSL_REQUIRED_ERROR;
	exit;
}
// Target URL for processing challenge responses - must use protocol sqrl://
$url = ICMS_URL . '/modules/login/sqrlauth.php?nut=' . $nonce 
		. '&amp;sqrlver=1'
		. '&amp;';
$url = str_replace('http', 'sqrl', $url);
QRcode::png($url, FALSE, "H", 4, 4);