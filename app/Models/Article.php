<?php

namespace App\Models;

use App\Helpers\DateHelper;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //use HasFactory;
    use SoftDeletes;

	/**
	 * Get the user that owns the article.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}


	/**
	 * Get the article's title.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getTitleAttribute($value)
	{
		if (! $value) return DateHelper::isoFormat($this->updated_at);
		return $value;
	}
}
