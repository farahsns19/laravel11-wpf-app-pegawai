<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'karyawan_id',
        'nama_jabatan',
        'gaji_pokok',
        'tunjangan'
    ];

    // Relasi ke Employee (satu jabatan dimiliki banyak pegawai)
    public function employees()
    {
        return $this->hasMany(Employee::class, 'karyawan_id');
    }
}
