<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $full_name
 * @property string|null $gender
 * @property Carbon|null $birthday
 * @property string|null $organization
 * @property bool $is_active
 * @property array|null $extra
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $casts = [
		'birthday' => 'datetime',
		'is_active' => 'bool',
		'extra' => 'json'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'gender',
		'birthday',
		'organization',
		'is_active',
		'extra'
	];
}
