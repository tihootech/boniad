<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
	protected $guarded = ['id'];

	public static function createOrUpdate($target_id, $class, $branch_id, $value)
	{
		$quantity = self::where('target_id', $target_id)
			->where('target_type', $class)
			->where('branch_id', $branch_id)
			->first();
		if ($quantity) {
			$quantity->update(compact('value'));
		}else {
			self::create([
				'branch_id' => $branch_id,
				'target_id' => $target_id,
				'target_type' => $class,
				'value' => $value,
			]);
		}
	}

	public function target()
	{
		return $this->morphTo();
	}
}
