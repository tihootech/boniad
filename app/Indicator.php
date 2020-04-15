<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
	protected $guarded = ['id'];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function raw_answer($evaluation_id, $registered_by_master=null)
	{
		if ($registered_by_master === null) {
			$registered_by_master = master();
		}
		$answer = Answer::where('evaluation_id', $evaluation_id)
			->where('indicator_id', $this->id)->where('registered_by_master', $registered_by_master)->first();
		return $answer->point ?? null;
	}

	public function quantity_target($branch_id)
	{
		$quantity = Quantity::where('branch_id', $branch_id)->where('target_id', $this->id)->where('target_type', self::class)->first();
		return $quantity ? $quantity->value : null;
	}

}
