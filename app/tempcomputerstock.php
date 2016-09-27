<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempcomputerstock extends Model
{
    //
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
                            'computer_name',
    						'computer_id',
                            'color_id',
    						'color_name',
    						'qty',
    						'cost',
                            'amount'
    						];		

    /**
     * Tempcomputerstock has many Comstocks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serialtemps()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = tempcomputerstock_id, localKey = id)
        return $this->hasMany('App\SerialTemp');
    }                            
}