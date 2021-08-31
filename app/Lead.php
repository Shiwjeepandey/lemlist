<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model{
    protected $table = "tbl_leads";
    protected $fillable = ['campaign_id','company','keyword','url','description','first_name','last_name','email','area_interest',
    'source','sdr','uploaded_by','is_inserted_lemlist','uploaded_sheet_id'];
	public function sheet(){
        return $this->belongsTo(Sheet::class,'sheet_id','id');
    }
	public function compaign(){
        return $this->belongsTo(Campaign::class,'campaign_id','campaign_id');
    }
}