<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName','ssn', 'mobile','email',
        'motherName', 'gender','birthDate',
        'edcQual', 'governorate','city',
        'street','building', 'socialState',
        'numOfChildren','marriageDate','church',
        'confessFather','img_url','servingType',
        'deaconLevel',
    ];

}
