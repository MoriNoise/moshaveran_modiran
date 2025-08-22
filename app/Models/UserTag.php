<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTag
 * 
 * @property int $id
 * @property int $user_id
 * @property int $tag_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class UserTag extends Model
{
	protected $table = 'user_tags';

	protected $casts = [
		'user_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'tag_id'
	];
}
