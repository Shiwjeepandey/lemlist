<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;
    protected $table = "activities";
    protected $fillable = ['email','campaign_id','raw_data','type','create_date'];
}
