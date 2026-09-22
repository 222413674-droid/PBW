<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $fillable = ['no', 'judul', 'tanggal_rilis', 'sampul', 'link'];

    protected $casts = ['tanggal_rilis' => 'date'];
}
