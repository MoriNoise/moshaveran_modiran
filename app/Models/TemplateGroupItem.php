<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateGroupItem
 * 
 * @property int $id
 * @property int $group_id
 * @property int $template_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TemplateGroupItem extends Model
{
	protected $table = 'template_group_items';

	protected $casts = [
		'group_id' => 'int',
		'template_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'template_id'
	];
}
