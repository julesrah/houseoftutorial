<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class damage extends Model
{
    use HasFactory;
    public $table = "damages";
    public $timestamps = true;
    public $primaryKey = "id";
    
    protected $fillable = [
        "title",
        "description",
        "imagePath"
    ];
}
