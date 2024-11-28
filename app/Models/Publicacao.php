<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{

    use HasFactory;

    protected $fillable = ['titulo', 'foto_url', 'user_id', 'status'];

    public function usuario() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
