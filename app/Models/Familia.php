<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
    
    /**
     * 
     *
     * @var string
     */
    protected $table = 'familias';
    
    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    
    /**
     * 
     */
    public function ciclos()
    {
        return $this->hasMany(Cicles::class, 'familia_id');
    }
} 