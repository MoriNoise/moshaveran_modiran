<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageBatch
 * 
 * @property int $id
 * @property string $name
 * @property int $platform_id
 * @property int|null $template_group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MessageBatch extends Model
{
	protected $table = 'message_batches';

	protected $casts = [
		'platform_id' => 'int',
		'template_group_id' => 'int'
	];

	protected $fillable = [
		'name',
		'platform_id',
		'template_group_id'
	];
}
