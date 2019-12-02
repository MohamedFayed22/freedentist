<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
	    protected $fillable = ['title','start_date','end_date','user_id','dentist_id','treatment_id','hospital_id','photo','is_diseases','diseases','is_drugs','drugs','status','follower_id','reason'];

}
