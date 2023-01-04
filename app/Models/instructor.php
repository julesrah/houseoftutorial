<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    use HasFactory;
    public $table = "instructors";
    public $timestamps = true;
    public $primaryKey = "id";
    
    protected $fillable = [
        "instructor_name",
        "user_id",
        "specialty",
        "instructor_description",
        "status",
        "address",
        "phonenumber",
        "imagePath"
    ];

    
}
