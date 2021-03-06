<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	    //
	/**
	 * Fields that can be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = ['title','body','user_id','photo_id','category_id',];

	/**
	 * Post belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\User');
	}

	/**
	 * Post belongs to Photo.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function photo()
	{
		// belongsTo(RelatedModel, foreignKey = photo_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\Photo');
	}

	/**
	 * Post belongs to Category.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		// belongsTo(RelatedModel, foreignKey = category_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\Category');
	}
}
