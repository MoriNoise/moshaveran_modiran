<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserGroupMember
 * 
 * @property int $id
 * @property int $group_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class UserGroupMember extends Model
{
	protected $table = 'user_group_members';

	protected $casts = [
		'group_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'user_id'
	];
}
