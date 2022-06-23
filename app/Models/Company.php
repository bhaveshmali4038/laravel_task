<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'companys';

    public function user_details()
{
    return $this->belongsTo(User::class,'user_id','id');
}

public function country_details()
{
    return $this->belongsTo(Country::class,'country_id','id');
}

}
        