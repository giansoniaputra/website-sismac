<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kredit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'unique';
    }

    public static function get_data($unique)
    {
        $query = DB::table('kredits as a')
            ->join('bikes as b', 'a.bike_id', '=', 'b.id')
            ->join('buyers as c', 'a.buyer_id', '=', 'c.id')
            ->select('a.*', 'b.no_polisi', 'b.merek', 'b.warna', 'b.tahun_pembuatan', 'c.nik', 'c.nama', 'c.tempat_lahir', 'c.tanggal_lahir', 'c.alamat', 'c.photo_ktp',)
            ->where('a.unique', $unique);
        return $query->first();
    }
}
