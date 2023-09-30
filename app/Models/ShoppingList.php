<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingList extends Model
{
    use SoftDeletes;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
	 public static function boot()
	 {
		 parent::boot();
 
		 self::creating(function($model) {
			if (is_null($model->options)) {
				$model->options = [
					'active' => false,
				];
			}
		 });
 
		 self::created(function($model) {
			 // ... code here
		 });
 
		 self::updating(function($model) {
			 // ... code here
		 });
 
		 self::updated(function($model) {
			 // ... code here
		 });
 
		 self::deleting(function($model) {
			 // ... code here
		 });
 
		 self::deleted(function($model) {
			 // ... code here
		 });
	 }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
    ];

	/**
	 * Get the user that owns the entity.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
