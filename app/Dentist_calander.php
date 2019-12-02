<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dentist_calander extends Model
{
        protected $fillable = ['hospital_id', 'service_id', 'start_date', 'end_date', 'day', 'start_time', 'end_time', 'status', 'flag'];

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
