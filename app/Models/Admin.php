<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

/**
 * Class Admin
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property bool $is_super
 * @property bool $is_active
 * @property string|null $avatar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Admin extends Authenticatable
{
	protected $table = 'admins';

	protected $casts = [
		'is_super' => 'bool',
		'is_active' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'username',
		'email',
		'password',
		'is_super',
		'is_active',
		'avatar'
	];
}
