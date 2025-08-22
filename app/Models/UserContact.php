<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserContact
 * 
 * @property int $id
 * @property int $user_id
 * @property int $platform_id
 * @property string $contact_identifier
 * @property bool $is_primary
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class UserContact extends Model
{
	protected $table = 'user_contacts';

	protected $casts = [
		'user_id' => 'int',
		'platform_id' => 'int',
		'is_primary' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'platform_id',
		'contact_identifier',
		'is_primary'
	];
}
