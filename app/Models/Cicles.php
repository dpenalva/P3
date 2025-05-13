<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicles extends Model
{
    use HasFactory;
    
    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nom del Cicle',
        'Nivell',
        'Família',
        'Descripció',
        'Valoració',
        'Opinió',
        'Email',
        'date',
        'hora',
        'familia_id',
    ];
    
    /**
     * 
     */
    public function familia()
    {
        return $this->belongsTo(Familia::class, 'familia_id');
    }
} 