<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;

    public $table = "admins";

    public $timestamps = true;

    public $primaryKey = "admin_id";
    
    protected $fillable = [
        "name",
        "job",
        "address",
        "phonenumber",
        "imagePath"
    ];
}
