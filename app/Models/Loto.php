<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loto extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'result' => 'array',
    ];

	/**
	 * Get the user that owns the article.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

    /**
     * 
     */
    protected function generate(Array $array, Int $count, Array $result)
    {
        shuffle($array);
        $rand = array_rand($array);
        array_push($result, $array[$rand]);
        unset($array[$rand]);
        if (count($result) == $count) {
            return $result;
        } else {
            return $this->generate($array, $count, $result);
        }
    }
}
