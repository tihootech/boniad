<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
	protected $guarded = ['id'];

	public function target()
	{
		return $this->morphTo();
	}
}
