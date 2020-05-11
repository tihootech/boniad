<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['ave'];

    public function getAveAttribute()
    {
        if ($this->master_sum && $this->self_sum) {
            return ($this->master_sum + $this->self_sum) / 2;
        }
    }

    public function getPointFor($indicator_id, $registered_by_master)
    {
        $answer = Answer::where('indicator_id', $indicator_id)->where('registered_by_master', $registered_by_master)->first();
        return $answer->point ?? null;
    }

	public function branch()
	{
		return $this->belongsTo(Branch::class);
	}

	public function answers()
	{
		return $this->hasMany(Answer::class);
	}
}
