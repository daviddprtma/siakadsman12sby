<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //
    protected $table = 'kelas';
    protected $fillable = ['kelas', 'tipe_kelas', 'tahun','gurus_id'];

    public function guru()
    {
        return $this->belongsTo('App\Guru','gurus_id');
    }

    public function siswa(){
        return $this->hasMany('App\Siswa','kelas_id');
    }
}
