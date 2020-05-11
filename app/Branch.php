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

    public function getQuantityValue($type, $target_id)
    {
        $target_type = class_name($type);
        $quantity = Quantity::where('branch_id', $this->id)->where('target_type', $target_type)->where('target_id', $target_id)->first();
        return $quantity->value ?? 0;
    }

    public function getConsumptionAmount($resource_id, $year, $quarter)
    {
        $consumption = Consumption::where('branch_id', $this->id)->where('resource_id', $resource_id)->where('year', $year)->where('quarter', $quarter)->first();
        return $consumption->amount ?? 0;
    }

    public function resource_patterns()
    {
        return $this->hasMany(Quantity::class)->where('target_type', Resource::class);
    }

    public function indicator_patterns()
    {
        return $this->hasMany(Quantity::class)->where('target_type', Indicator::class);
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
