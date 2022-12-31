<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    public $table = "services";
    public $timestamps = true;
    public $primaryKey = "id";
    
    protected $fillable = [
        "instructor_id",
        "instrument_id",
        "servname",
        "eventStarts",
        "description",
        "price",
        "imagePath"
    ];

    
}
