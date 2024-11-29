<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publicacao extends Model
{
    protected $table = 'publicacoes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'foto_url',
        'status',
        'titulo',
        'local',
        'data'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    use HasFactory;
}


