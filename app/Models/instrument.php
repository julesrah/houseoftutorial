<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instrument extends Model
{
    use HasFactory;
    public $table = "instruments";
    public $timestamps = true;
    public $primaryKey = "id";
    
    protected $fillable = [
        "name",
        "type",
        "description",
        "condition",
        "imagePath"
    ];
}
