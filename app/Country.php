<?php

namespace App;

use IlluminateDatabaseEloquentModel;

class Country extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
}