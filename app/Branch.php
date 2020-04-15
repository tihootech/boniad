<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function indicators_not_completed()
    {
        $indicators = Indicator::count();
        $quantities = Quantity::where('branch_id', $this->id)->where('target_type', Indicator::class)->count();
        return $indicators != $quantities;
    }

    public function resources_not_completed()
    {
        $indicators = Resource::count();
        $quantities = Quantity::where('branch_id', $this->id)->where('target_type', Resource::class)->count();
        return $indicators != $quantities;
    }
}
