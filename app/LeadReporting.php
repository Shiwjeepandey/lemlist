<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadReporting extends Model
{
    protected $table = "tbl_reporting_leads";
    protected $fillable = ['campaign_id','company','keyword','url','description','first_name','last_name','email','area_interest',
    'source','sdr','is_inserted_lemlist'];
}
