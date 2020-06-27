<?php
if (!function_exists('check_current_method_similar')) {
	function check_current_method_similar($methodName = null)
	{
		$ci = &get_instance();
		return strpos($ci->router->fetch_method(), $methodName) !== false;
	}
}


// -----------------------------------------------------------
// 					USER_CAN FUNCTION
// -----------------------------------------------------------
if (!function_exists('user_can')) {
	/** Check Current User Access Power For Executed Function
	 *
	 * @param string $action Name of Action
	 * @return bool */
	function user_can(string $action = null)
	{
		return vars_exists($action)
			and vars_exists($_SESSION['USER_TYPE'])
			and vars_exists($_SESSION['USER_ROLE'])
			and vars_exists($_SESSION['USER_POWER'])
			and in_array($action, $_SESSION['USER_POWER']);
	}
}


// -----------------------------------------------------------
// 					CHECK_SELECTED FUNCTION
// -----------------------------------------------------------
if (!function_exists('check_selected')) {
	/** Compare Two Variable & Print Message
	 *
	 * @param mixed $first First Variable
	 * @param mixed $second Second Variable
	 * @param string $msg Message to Print
	 * @return bool|string */
	function check_selected($first = null, $second = null, string $msg = null)
	{
		return $first == $second and print($msg);
	}
}


// -----------------------------------------------------------
// 					IS FUNCTION
// -----------------------------------------------------------
if (!function_exists('is')) {
	/** Check Variable Exists or Not
	 *
	 * If Action is Defined & Variable Exists, Then Do Action
	 *
	 * @param mixed $param Parameter
	 * @param string $action ex. `show`, `showCapital`, `price`, `json`, `rating`, `array`, `date`, `datetime`
	 * @return bool */
	function is(&$param = null, ?string $action = null)
	{
		if (is_null($action)) {
			return isset($param) and $param !== false and $param != '' and !empty($param);
		} elseif (!is_null($action) and $action === 'array') {
			return isset($param) and $param !== false and $param != '' and !empty($param) and is_array($param);
		} elseif (!is_null($action) and $action === 'json') {
			return isset($param) and $param !== false and $param != '' and !empty($param) and is_object($param);
		} elseif (!is_null($action) and $action === 'show') {
			return isset($param) and $param !== false and $param != '' and print($param);
		} elseif (!is_null($action) and $action === 'showCapital') {
			return isset($param) and $param !== false and $param != '' and !empty($param) and print(ucwords($param));
		} elseif (!is_null($action) and $action === 'price') {
			return isset($param) and $param !== false and $param != '' and !empty($param) and print(price_format($param));
		} elseif (!is_null($action) and $action === 'rating') {
			return isset($param) and $param !== false and $param != '' and is_numeric($param) and print(show_rating($param));
		} elseif (!is_null($action) and $action === 'date') {
			return isset($param) and $param !== false and $param != '' and !empty($param) and print(_date_format($param));
		} elseif (!is_null($action) and $action === 'datetime') {
			return isset($param) and $param !== false and $param != '' and !empty($param) and print(_datetime_format($param));
		}
		return false;
	};
}

/** `Show Message Function`
 *
 * Show Error Message on Page
 * @param string $ErrorMessage Display Message String */
function error_show($ErrorMessage)
{
	return exit(print("<center style='color: #3a4161'><h1 style='margin: 25% 0%;font-family: serif; font-size: 40px'>" . $ErrorMessage . "</h1></center>"));
}


// -----------------------------------------------------------
// 					IS_LOGIN FUNCTION
// -----------------------------------------------------------
if (!function_exists('is_login')) {
	/** Check Current User is Login
	 *
	 * @return bool */
	function is_login()
	{
		return is($_SESSION['USER_ROLE']) and is($_SESSION['LOGIN']) and is($_SESSION['USER_ID']) and is($_SESSION['USER_TYPE']) and is($_SESSION['USER_NAME']);
	}
}


// -----------------------------------------------------------
// 					str_clean FUNCTION
// -----------------------------------------------------------
if (!function_exists('str_clean')) {
	/** Clean Spacial Character in String
	 *
	 * @param string $string
	 * @param array $OptionalCharacter
	 * @return string */
	function str_clean(string $String, $OptionalCharacter = null, string $functionType = null)
	{
		/** Special Characters
		 * @var array $SpecialChars */
		$SpecialChars = ["`", "-", "_", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "]", "{", "}", ";", ":", "'", '"', "\\", "|", ",", ".", "<", ">", "/", "?", " "];
		is_null($OptionalCharacter) or is_array($OptionalCharacter) and $SpecialChars = array_diff($SpecialChars, $OptionalCharacter);
		$String = trim(strtolower(htmlspecialchars(preg_replace("/[^a-zA-Z0-9 .@\/_-]/", "", str_replace($SpecialChars, "", $String)), ENT_QUOTES, 'UTF-8')));
		isset($functionType) and !empty($functionType) and $functionType === 'slug' and $String = str_replace([' ', '-', '_'], ['-', '-', '-'], $String);
		return $String;
	}
}


// -----------------------------------------------------------
// 					CHECK_CURRENT_PAGE FUNCTION
// -----------------------------------------------------------
if (!function_exists('check_current_page')) {
	/** Check Current Page
	 *
	 * @param string $controllerWithMethod
	 * @return bool */
	function check_current_page($controllerWithMethod)
	{
		$ci = &get_instance();
		return strtolower($ci->router->fetch_class() . '/' . $ci->router->fetch_method()) === $controllerWithMethod;
	}
}


// -----------------------------------------------------------
// 					CHECK_CURRENT_METHOD FUNCTION
// -----------------------------------------------------------
if (!function_exists('check_current_method')) {
	/** Check Current Method
	 *
	 * @param string $methodName
	 * @return bool */
	function check_current_method($methodName)
	{
		$ci = &get_instance();
		return strpos($ci->router->fetch_method(), strtolower($methodName)) !== false;
	}
}


// -----------------------------------------------------------
// 					CHECK_CURRENT_METHOD FUNCTION
// -----------------------------------------------------------
if (!function_exists('check_selected_option')) {
	/** Check Current Method
	 *
	 * @param string $methodName
	 * @return bool */
	function check_selected_option($OptionValue, $SelectedOptionValue)
	{
		return strtolower($OptionValue) === strtolower($SelectedOptionValue) and print ('value="' . $OptionValue . '" selected="selected"') or print('value="' . $OptionValue . '"');
	}
}


// -----------------------------------------------------------
// 					HTML_HEADING_MSG FUNCTION
// -----------------------------------------------------------
if (!function_exists('html_heading_msg')) {
	/** Send HTML Error Message
	 *
	 * Return `HTML String` if Message Not Empty
	 *
	 * HTML Style using `Heading Third Tag`
	 *
	 * @param string $message Error Message
	 * @return string|null */
	function html_heading_msg(string $message = null)
	{
		if (!vars_exists($message)) return;
		return "<h3 class='bg-light p-3'>$message</h3>";
	}
}


// -----------------------------------------------------------
// 					VARS_EXISTS FUNCTION
// -----------------------------------------------------------
if (!function_exists('vars_exists')) {
	/** Check Variable Exists
	 *
	 * Return `true` if the given function has been defined
	 *
	 * `true` if function_name exists and is a function, `false` otherwise.
	 *
	 * Check `is_null`, `empty` and `===`
	 *
	 * @param mixed $var Variable
	 * @return bool */
	function vars_exists($var = null)
	{
		return !(is_null($var) or empty($var) or $var === '');
	}
}

/* End of file Valid.php */
