<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    public $table = "clients";
    public $timestamps = true;
    public $primaryKey = "id";
    
    protected $fillable = [
        "title",
        "user_id",
        "firstName",
        "lastName",
        "age",
        "sex",
        "address",
        "phonenumber",
        "imagePath"
    ];

    public function orders() {
        return $this->hasMany('App\Models\orderinfo', 'client_id');
    }
}
