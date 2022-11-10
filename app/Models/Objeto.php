<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable= ['name','foto','descripcion'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}
