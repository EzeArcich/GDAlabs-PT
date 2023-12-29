<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'customers';
    protected $primaryKey = 'dni';

    protected $fillable = [
        'dni', 'id_reg', 'id_com', 'email', 'name', 'last_name', 'address', 'status',
    ];
}
