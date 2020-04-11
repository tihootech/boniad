<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $guarded = ['id'];
	protected $appends = ['max_points'];

	public function getMaxPointsAttribute()
	{
		return Indicator::where('category_id', $this->id)->sum('points');
	}

	public function indicators()
	{
		return $this->hasMany(Indicator::class);
	}

	public function next()
	{
		$id = self::where('id', '>', $this->id)->min('id');
		return $id ? self::find($id) : null;
	}

	public function prev()
	{
		$id = self::where('id', '<', $this->id)->max('id');
		return $id ? self::find($id) : null;
	}

	public function points_for($evaluation_id, $registered_by_master)
	{
		$indicator_ids = $this->indicators->pluck('id');
		return Answer::where('evaluation_id', $evaluation_id)->where('registered_by_master', $registered_by_master)->whereIn('indicator_id', $indicator_ids)->sum('point');
	}
}
