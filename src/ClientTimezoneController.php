<?php

/*
 * (c) Kevin Orriss <hello@kevinorriss.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinOrriss\ClientTimezone;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

/**
 * Handles all application logic for the client timezone
 */
class ClientTimezoneController extends Controller
{
	/**
	 * Processes the Ajax post request and stores the
	 * timezone offset (minutes) in the session
	 *
	 * @param Request @request
	 */
	public function postClientTimezone(Request $request)
	{
		ClientTimezone::setOffset($request->input('timezoneoffset'));
	}
}
