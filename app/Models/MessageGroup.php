<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MessageGroup extends Model
{
    protected $table = 'message_groups';

    protected $casts = [
        'created_by' => 'int',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];

    // Group creator
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Users in the group
    public function users()
    {
        return $this->belongsToMany(User::class, 'message_group_users', 'group_id', 'user_id')
            ->withTimestamps();
    }

    // Messages sent to the group
    public function messages()
    {
        return $this->hasMany(GroupMessage::class, 'group_id');
    }

    public function template()
    {
        // Only the first (or single) group_message record
        return $this->hasOne(GroupMessage::class, 'group_id');
    }
    public function templateApi()
    {
        return $this->hasOne(GroupMessage::class, 'group_id')
            ->with(['template', 'group']); // load all related models
    }

    public function groupMessage()
    {
        return $this->hasOne(GroupMessage::class, 'group_id');
    }



}
