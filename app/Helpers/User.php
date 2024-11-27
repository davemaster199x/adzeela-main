<?php

namespace App\Helpers;
use Auth;
use App\Position;
use Illuminate\Support\Facades\DB;

class User {

	public static function get_name($user_id)
	{
		$user = DB::table('users')->where('id', $user_id)->first();
		$name = $user->name;
		$name = explode(' ', trim($name));
		return (isset($user->name) ? $name[0] : '');
	}

	public static function get_username($user_id)
	{
		$user = DB::table('users')->where('id', $user_id)->first();

		return (isset($user->username) ? $user->username : '');
	}

}