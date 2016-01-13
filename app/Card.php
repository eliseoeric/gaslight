<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //

	protected $fillable = ['title', 'url'];

	/**
	 * Get the user that owns the card
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( User::class );
	}

	public function tags() {
		return $this->belongsToMany( Tag::class );
	}
}
