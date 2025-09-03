<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageGroupUser
 *
 * @property int $id
 * @property int $group_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MessageGroupUser extends Model
{
	protected $table = 'message_group_users';

	protected $casts = [
		'group_id' => 'int',
		'user_id' => 'int'
	];

    public function group()
    {
        return $this->belongsTo(MessageGroup::class, 'group_id');
    }

    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'sent_by');
    }

	protected $fillable = [
		'group_id',
		'user_id'
	];
}
