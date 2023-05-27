<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Buyer;
use App\Models\Kredit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'no_polisi' => 'required',
            'jenis_pembayaran' => 'required',
            'tanggal_jual' => 'required',
            'nama_pembeli' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'harga_jual_kredit' => 'required',
            'dp_bayar' => 'required',
            'pencairan' => 'required',
            'angsuran' => 'required',
            'tenor' => 'required',
            'komisi' => 'required',

        ];
        $pesan = [
            'no_polisi.required' => 'Pilih Nomor Polisi',
            'jenis_pembayaran.required' => 'Pilih Jenis Pembayaran',
            'tanggal_jual.required' => 'Tidak boleh kosong',
            'nama_pembeli.required' => 'Tidak boleh kosong',
            'nik.required' => 'Tidak boleh kosong',
            'alamat.required' => 'Tidak boleh kosong',
            'tempat_lahir.required' => 'Tidak boleh kosong',
            'tanggal_lahir.required' => 'Tidak boleh kosong',
            'jenis_kelamin.required' => 'Tidak boleh kosong',
            'harga_jual_kredit.required' => 'Tidak boleh kosong',
            'dp_bayar.required' => 'Tidak boleh kosong',
            'pencairan.required' => 'Tidak boleh kosong',
            'angsuran.required' => 'Tidak boleh kosong',
            'tenor.required' => 'Tidak boleh kosong',
            'komisi.required' => 'Tidak boleh kosong',
        ];
        //Mengubah base64 menjadi file image

        if ($request->photo_ktp) {
            $jenis_file = explode(":", $request->photo_ktp);
            $jenis_file2 = explode("/", $jenis_file[1]);
            $jenis_foto = $jenis_file2[0];
        }
        // Validasi Photo KTP
        $validator_photo_ktp = Validator::make([
            'photo_ktp' => base64_encode($request->photo_ktp),
        ], [
            'photo_ktp' => 'max:' . (2 * 1024 * 1024) // Batasan ukuran 2 megabyte
        ], [
            'photo_ktp.max' => 'Ukuran tidak boleh lebih dari 2MB.',
        ]);
        //Validasi base64 apakah sebuah gambar
        //Validasi Inputan yang Lain
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            $send_error = [
                'errors' => $validator->errors(),
            ];
            if ($validator_photo_ktp->fails()) {
                $send_error['error_ktp'] = $validator_photo_ktp->errors();
            }
            if ($request->photo_ktp && $jenis_foto != 'image') {
                $send_error['error_ktp_type'] = 'File harus berupa gambar';
            }
            return response()->json($send_error);
        } else if ($validator_photo_ktp->fails()) {
            $send_error = [
                'error_ktp' => $validator_photo_ktp->errors(),
            ];
            return response()->json($send_error);
        } else if ($request->photo_ktp && $jenis_foto != 'image') {
            return response()->json(['error_ktp_type' => 'File harus berupa gambar',]);
        } else {
            //Cek apakah nik yang dikirim terdaftar di table buyers
            $buyer = Buyer::where('nik', $request->nik)->first();
            //Jika nik terdaftar di table
            if (!$buyer) {
                //Jika nik tidak ada di table
                $data_buyer = [
                    'unique' => Str::orderedUuid(),
                    'nik' => $request->nik,
                    'nama' => ucwords(strtolower($request->nama_pembeli)),
                    'alamat' => $request->alamat,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ];
                //Upload jika ada gambar
                if ($request->photo_ktp) {
                    $base_Image = $request->photo_ktp;  // your base64 encoded

                    $jenis_file = explode(":", $request->photo_ktp);
                    $jenis_file2 = explode("/", $jenis_file[1]);
                    $jenis_file3 = explode(";", $jenis_file2[1]);
                    $jenis_foto = $jenis_file3[0];
                    if ($jenis_foto == 'jpeg') {
                        $base_Image = str_replace('data:image/jpeg;base64,', '', $base_Image);
                    } else if ($jenis_foto == 'jpg') {
                        $base_Image = str_replace('data:image/jpg;base64,', '', $base_Image);
                    } else if ($jenis_foto == 'png') {
                        $base_Image = str_replace('data:image/png;base64,', '', $base_Image);
                    }
                    $base_Image = str_replace(' ', '+', $base_Image);
                    $name_Image = Str::random(40) . '.' . 'png';
                    File::put(storage_path() . '/app/public/ktp_pembeli/' . $name_Image, base64_decode($base_Image));
                    $data_buyer['photo_ktp'] = $name_Image;
                }
                Buyer::create($data_buyer);
            }
            //Membuat random nota
            $trx = 'TRX-KRDT-00';
            $last_trx = Kredit::latest()->first();;
            if ($last_trx == NULL) {
                $random_num = 1;
            } else {
                $last_nota = explode('-', $last_trx->nota);
                $random_num = $last_nota[2] + 1;
            }
            $nota = $trx . $random_num;
            $data_kredit = [
                'unique' => Str::orderedUuid(),
                'nota' => $nota,
                'bike_id' => $request->no_polisi,
                'tanggal_jual' => $request->tanggal_jual,
                'harga_beli' => preg_replace('/[,]/', '', $request->harga_beli),
                'harga_jual' => preg_replace('/[,]/', '', $request->harga_jual_kredit),
                'dp' => preg_replace('/[,]/', '', $request->dp_bayar),
                'pencairan' => preg_replace('/[,]/', '', $request->pencairan),
                'angsuran' => preg_replace('/[,]/', '', $request->angsuran),
                'tenor' => $request->tenor,
                'komisi' => preg_replace('/[,]/', '', $request->komisi),
            ];
            if ($buyer) {
                $data_kredit['buyer_id'] = $buyer->id;
            } else if (!$buyer) {
                $last_input = Buyer::latest()->first();
                $data_kredit['buyer_id'] = $last_input->id;
            }
            Kredit::create($data_kredit);
            Bike::where('id', $request->no_polisi)->update(['status' => 'TERJUAL']);
            return response()->json(['success' => 'Data Penjualan Berhasil Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kredit $kredit)
    {
        //
    }

    public function get_data_kredit(Request $request)
    {
        $query = Kredit::get_data($request->unique);
        return response()->json(['data' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kredit $kredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kredit $kredit)
    {
        $rules = [
            'tanggal_jual' => 'required',
            'nama_pembeli' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'harga_jual_kredit' => 'required',
            'dp_bayar' => 'required',
            'pencairan' => 'required',
            'angsuran' => 'required',
            'tenor' => 'required',
            'komisi' => 'required',

        ];
        $pesan = [
            'tanggal_jual.required' => 'Tidak boleh kosong',
            'nama_pembeli.required' => 'Tidak boleh kosong',
            'nik.required' => 'Tidak boleh kosong',
            'alamat.required' => 'Tidak boleh kosong',
            'tempat_lahir.required' => 'Tidak boleh kosong',
            'tanggal_lahir.required' => 'Tidak boleh kosong',
            'jenis_kelamin.required' => 'Tidak boleh kosong',
            'harga_jual_kredit.required' => 'Tidak boleh kosong',
            'dp_bayar.required' => 'Tidak boleh kosong',
            'pencairan.required' => 'Tidak boleh kosong',
            'angsuran.required' => 'Tidak boleh kosong',
            'tenor.required' => 'Tidak boleh kosong',
            'komisi.required' => 'Tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        // Validasi Photo KTP
        $validator_photo_ktp = Validator::make([
            'photo_ktp' => base64_encode($request->photo_ktp),
        ], [
            'photo_ktp' => 'max:' . (2 * 1024 * 1024) // Batasan ukuran 2 megabyte
        ], [
            'photo_ktp.max' => 'Ukuran tidak boleh lebih dari 2MB.',
        ]);
        //Validasi jenis file upload
        if ($request->photo_ktp) {
            $jenis_file = explode(":", $request->photo_ktp);
            $jenis_file2 = explode("/", $jenis_file[1]);
            $jenis_foto = $jenis_file2[0];
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else if ($validator_photo_ktp->fails()) {
            $send_error = [
                'error_ktp' => $validator_photo_ktp->errors(),
            ];
            return response()->json($send_error);
        } else if ($request->photo_ktp && $jenis_foto != 'image') {
            return response()->json(['error_ktp_type' => 'File harus berupa gambar',]);
        } else {
            //Cek apakah user mengganti nik dengan user lain yang terdaftar
            $cek_sele = Kredit::where('unique', $request->current_unique)->first();
            $cek_buyer = Buyer::where('id', $cek_sele->buyer_id)->first();
            $cek_buyer_nik = Buyer::where('nik', "=", $request->nik)->where('nik', "!=", $cek_buyer->nik)->first();

            $data_penjualan = [
                'tanggal_jual' => $request->tanggal_jual,
                'harga_beli' => preg_replace('/[,]/', '', $request->harga_beli),
                'harga_jual' => preg_replace('/[,]/', '', $request->harga_jual_kredit),
                'dp' => preg_replace('/[,]/', '', $request->dp_bayar),
                'pencairan' => preg_replace('/[,]/', '', $request->pencairan),
                'angsuran' => preg_replace('/[,]/', '', $request->angsuran),
                'tenor' => $request->tenor,
                'komisi' => preg_replace('/[,]/', '', $request->komisi),
            ];
            if ($cek_buyer_nik) {
                $data_penjualan['buyer_id'] = $cek_buyer_nik->id;
            }
            $data_penjual = [
                'nik' => $request->nik,
                'nama' => ucwords(strtolower($request->nama_pembeli)),
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                // 'jenis_kelamin' => $request->jenis_kelamin,
            ];
            //Jika ada  upload foto
            if ($request->photo_ktp) {
                $base_Image = $request->photo_ktp;  // your base64 encoded

                $jenis_file = explode(":", $request->photo_ktp);
                $jenis_file2 = explode("/", $jenis_file[1]);
                $jenis_file3 = explode(";", $jenis_file2[1]);
                $jenis_foto = $jenis_file3[0];
                if ($jenis_foto == 'jpeg') {
                    $base_Image = str_replace('data:image/jpeg;base64,', '', $base_Image);
                } else if ($jenis_foto == 'jpg') {
                    $base_Image = str_replace('data:image/jpg;base64,', '', $base_Image);
                } else if ($jenis_foto == 'png') {
                    $base_Image = str_replace('data:image/png;base64,', '', $base_Image);
                }
                $base_Image = str_replace(' ', '+', $base_Image);
                $name_Image = Str::random(40) . '.' . 'png';
                File::put(storage_path() . '/app/public/ktp_pembeli/' . $name_Image, base64_decode($base_Image));
                if ($request->old_ktp) {
                    Storage::delete($request->old_ktp);
                }
                $data_penjual['photo_ktp'] = $name_Image;
            }
            $buyer_id = Kredit::where('unique',  $request->current_unique)->first();
            if ($cek_buyer_nik) {
                Buyer::where('id', $cek_buyer_nik->buyer_id)->update($data_penjual);
            } else {
                Buyer::where('id', $buyer_id->buyer_id)->update($data_penjual);
            }
            Kredit::where('unique', $request->current_unique)->update($data_penjualan);
            return response()->json(['success' => 'Data Penjualan Berhasil Diupdate']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kredit $kredit)
    {
        //
    }

    public function dataTables()
    {
        $query = DB::table('kredits as a')
            ->join('bikes as b', 'b.id', '=', 'a.bike_id')
            ->join('buyers as c', 'c.id', '=', 'a.buyer_id')
            ->select('a.*', 'b.no_polisi', 'b.merek', 'b.warna', 'b.status', 'c.nama')
            ->get();
        foreach ($query as $row) {
            $row->tanggal_jual = tanggal_hari($row->tanggal_jual);
            $row->harga_jual = rupiah($row->harga_jual);
        }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '<button class="btn btn-info btn-sm info-button-kredit" data-unique="' . $row->unique . '"><i class="flaticon-381-view-2"></i></button>
                <button class="btn btn-success btn-sm edit-button-kredit" data-unique="' . $row->unique . '"><i class="flaticon-381-edit-1"></i></button>
                <button type="button" class="btn btn-warning btn-sm retur-button-kredit"  data-unique="' . $row->unique . '"><i class="flaticon-381-back-2 text-white"></i></button>
                <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="d-inline form-delete">
                    <button type="button" class="btn btn-danger btn-sm delete-button-kredit" data-token="' . csrf_token() . '" data-unique="' . $row->unique . '"><i class="flaticon-381-trash-1"></i></button>
                </form>';
            return $actionBtn;
        })->make(true);
    }
}
