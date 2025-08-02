<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = 'labels';

    protected $fillable = [
        'name',
        'icon',
        'color',
    ];

    /**
     * Relació: una etiqueta pot tenir molts productes
     */
    public function products()
    {
        return $this->hasMany(Products::class, 'label_id');
    }
}
