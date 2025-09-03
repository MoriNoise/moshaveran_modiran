<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupMessage
 *
 * @property int $id
 * @property int $group_id
 * @property int $template_id
 * @property int|null $sent_by
 * @property Carbon $sent_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class GroupMessage extends Model
{
	protected $table = 'group_messages';

	protected $casts = [
		'group_id' => 'int',
		'template_id' => 'int',
		'sent_by' => 'int',
		'sent_at' => 'datetime'
	];
    // Relation: which template this group message is using
    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    // Optional: relation back to group
    public function group()
    {
        return $this->belongsTo(MessageGroup::class, 'group_id');
    }

    
	protected $fillable = [
		'group_id',
		'template_id',
		'sent_by',
		'sent_at'
	];
}
