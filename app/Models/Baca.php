<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baca extends Model
{
    use HasFactory;
    protected $table = 'baca';
    protected $guarded = ['id'];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
