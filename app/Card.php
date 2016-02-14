<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //

	protected $fillable = ['title', 'url', 'og_image', 'desc'];

	/**
	 * Get the user that owns the card
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo( User::class );
	}

	public function tag( $tag )
	{
		$this->tags()->save($tag);
	}

	public function tags()
	{
		return $this->belongsToMany( Tag::class );
	}

	public function countTags()
	{
		return $this->tags()->count();
	}
}
