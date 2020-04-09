<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
	protected $guarded = ['id'];

	public function branch()
	{
		return $this->belongsTo(Branch::class);
	}

	public function resource()
	{
		return $this->belongsTo(Resource::class);
	}
}
