<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageTemplate
 * 
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string|null $category
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MessageTemplate extends Model
{
	protected $table = 'message_templates';

	protected $fillable = [
		'name',
		'content',
		'category'
	];
}
