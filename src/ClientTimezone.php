<?php

/*
 * (c) Kevin Orriss <hello@kevinorriss.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinOrriss\ClientTimezone;

use Session;

/**
 * A simple API extension for getting a users timezone via JavaScript
 */
class ClientTimezone
{
	/**
	 * The session key where the timezone offset is stored
	 *
	 * @var string
	 */
	const CLIENT_TIMEZONE_SESSION = "clienttimezone";

	/**
	 * The URL entered for the Ajax post in javascript.blade.php
	 *
	 * @var string
	 */
	const CLIENT_TIMEZONE_POST = "clienttimezone";

	/**
	 * The session key for if checking the client timezone should be skipped
	 *
	 * @var string
	 */
	const CLIENT_TIMEZONE_SKIP = "clienttimezoneskip";


	/**
	* Returns the session key where the timezone offset is stored.
	* This key can be overriden by adding CLIENT_TIMEZONE_SESSION
	* to the .env file
	*
	* @return string
	*/
	protected static function getOffsetSessionKey()
	{
		return env('CLIENT_TIMEZONE_SESSION', self::CLIENT_TIMEZONE_SESSION);
	}

	/**
	* Returns the URL entered for the Ajax post in javascript.blade.php
	* This URL can be overriden by adding CLIENT_TIMEZONE_POST
	* to the .env file
	*
	* @return string
	*/
	public static function getPostUrl()
	{
		return env('CLIENT_TIMEZONE_POST', self::CLIENT_TIMEZONE_POST);
	}

	/**
	 * Returns the session key where the skip flag is stored
	 *
	 * @return string
	 */
	protected static function getSkipSessionKey()
	{
		return env('CLIENT_TIMEZONE_SKIP', static::CLIENT_TIMEZONE_SKIP);
	}

	/**
	 * Returns if the client timezone is stored in session or not
	 *
	 * @return boolean
	 */
	protected static function hasOffset()
	{
		return Session::has(static::getOffsetSessionKey());
	}

	/**
	 * Returns the client timezone as the number of minutes offset from the current UTC time.
	 * If the client timezone is not set in the session, NULL is returned
	 *
	 * @return integer|NULL
	 */
	public static function getOffset()
	{
		if (static::hasOffset())
		{
			return intval(Session::get(static::getOffsetSessionKey()));
		}
		return NULL;
	}

	/**
	 * Sets the number of minutes offset from the current UTC time in the session
	 *
	 * @param integer $offset
	 */
	public static function setOffset($offset)
	{
		Session::put(static::getOffsetSessionKey(), intval($offset));
	}

	/**
	 * Removes the timezone offset from the session
	 */
	public static function forget()
	{
		Session::forget(static::getOffsetSessionKey());
	}

	/**
	 * Sets the skip flag to true, meaning that the javascript will not check for the client timezone
	 */
	public static function skip()
	{
		Session::flash(static::getSkipSessionKey(), TRUE);
	}

	/**
	 * Returns if checking the client timezone is going to be skipped or not
	 *
	 * @return boolean
	 */
	protected static function skipping()
	{
		return Session::has(static::getSkipSessionKey()) && Session::get(static::getSkipSessionKey()) == TRUE;
	}

	/**
	 * Returns if the client timezone will be checked or not
	 *
	 * @return boolean
	 */
	public static function checking()
	{
		return !static::skipping() && is_null(static::getOffset());
	}
}