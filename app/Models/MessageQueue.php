<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageQueue
 * 
 * @property int $id
 * @property int $batch_id
 * @property int $user_contact_id
 * @property string $message_content
 * @property string $status
 * @property Carbon|null $sent_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MessageQueue extends Model
{
	protected $table = 'message_queue';

	protected $casts = [
		'batch_id' => 'int',
		'user_contact_id' => 'int',
		'sent_at' => 'datetime'
	];

	protected $fillable = [
		'batch_id',
		'user_contact_id',
		'message_content',
		'status',
		'sent_at'
	];
}
