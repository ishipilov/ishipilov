<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use HasFactory;
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
	public function getTitleSubAttribute($value)
	{
		if (! $this->title) return DateHelper::isoFormat($this->updated_at);
		return $this->title;
	}

	/**
	 * If article is published.
	 *
	 * @return boolean
	 */
	public function getIsPublishedAttribute()
	{
		return !empty($this->published_at);
	}

	/**
	 * Get the article's publish date.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getPublishedDateAttribute($value)
	{
		if ($this->published_at) return DateHelper::isoFormat($this->published_at);
		return $this->published_at;
	}

	/**
	 * Scope a query to ordered articles.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return void
	 */
	public function scopeOrdered($query)
	{
		$query->orderByDesc('id')
		->orderByDesc('created_at')
		->orderByDesc('updated_at');
	}

	/**
	 * Scope a query to only include published articles.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return void
	 */
	public function scopePublished($query)
	{
		$query->whereNotNull('published_at');
	}
}
