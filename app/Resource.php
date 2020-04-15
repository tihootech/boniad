<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	protected $guarded = ['id'];

	public function quantity_target($branch_id)
	{
		$quantity = Quantity::where('branch_id', $branch_id)->where('target_id', $this->id)->where('target_type', self::class)->first();
		return $quantity ? $quantity->value : null;
	}
}
