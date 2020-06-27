<?php

/** Error Message
 * @author Krishna Gujjjar <krishnagujjjar@gmail.com> */
trait errorMsg
{
	/** `Show Message Function`
	 *
	 * Show Error Message on Page
	 * @param string $ErrorMessage Display Message String */
	public static function Show(string $ErrorMessage)
	{
		return exit(print("<center style='color: #3a4161'><h1 style='margin: 25% 0%;font-family: serif; font-size: 40px'>" . $ErrorMessage . "</h1></center>"));
	}

	/** `Get Protocol Function`
	 * return string https:// or http://
	 */
	public static function get_protocol()
	{
		/** @var string $protocol Server Protocol */ (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] === 'on') and
			$protocol = 'https://' or
			$protocol = 'http://';
		return $protocol;
	}
}
