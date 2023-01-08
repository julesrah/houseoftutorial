<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderinfo extends Model
{
    use HasFactory;
    
    protected $table = 'service_orderinfo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['client_id','schedule','status'];

    public function sessions() {
        return $this->belongsToMany(session::class, 'session', 'service_id')->withPivot('session');
    }
}
