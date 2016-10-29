<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App;

class Household extends Model
{

    /**
     * @var string
     */
    protected $table = 'household';

    /**
     * Get the Sessions for the Household
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

}