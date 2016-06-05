<?php

Route::post(ClientTimezone::getPostUrl(),
	'KevinOrriss\ClientTimezone\ClientTimezoneController@postClientTimezone')->middleware('web');