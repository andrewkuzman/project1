<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Related extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memberssn','memberType', 'husbandssn',
        ];
}
