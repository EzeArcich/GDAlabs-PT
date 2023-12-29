<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regions';
    protected $primaryKey = 'id_reg'; 

    public function communes()
    {
        return $this->hasMany(Commune::class, 'id_reg', 'id_reg');
    }
}
