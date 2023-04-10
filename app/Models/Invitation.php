<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    //use HasFactory;
	use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'hash',
    ];
    
    /**
     * Get the user associated with the invitation.
     */
    public function target_user()
    {
        return $this->hasOne(User::class, 'id', 'target_user_id');
    }

	/**
	 * Get the user that created the invitation.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
