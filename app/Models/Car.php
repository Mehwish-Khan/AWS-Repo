<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [];

    //a car model belongs to a car
    public function carmodel()
    {
        return $this->hasMany(carModel::class);
    }

    public function headquarter()
    {
        return $this->hasOne(Headquarter::class);
    }

    //has many through relationship
    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class,
            carModel::class,
            'car_id', //Foreign key on CarModel table
            'model_id' //Foreign key on Engine table
        );
    }

    //define a has one through relationship
    public function productiondate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            carModel::class,
            'car_id',
            'model_id'
        );
    }

    //Defining many to many relationship
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
