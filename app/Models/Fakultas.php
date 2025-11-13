<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';
    protected $fillable = ['kode_fakultas', 'nama_fakultas'];

    // relasi: satu fakultas punya banyak prodi
    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'fakultas_id');
    }
}
