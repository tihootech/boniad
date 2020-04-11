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

	public function branch()
	{
		return $this->belongsTo(Branch::class);
	}
}
