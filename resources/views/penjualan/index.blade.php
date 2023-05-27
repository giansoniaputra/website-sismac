@extends('layout.main')
@section('container')
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<div id="pesan" data-flash="{{ session('success') }}"></div>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-rounded btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg" id="btn-add-data"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i>
            </span>Tambah Data Penjualan</button>
        <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="modal-transaksi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Penjualan</h5>
                        <button type="button" class="close tutup" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:;" enctype="multipart/form-data" id="form-penjualan">
                            @csrf
                            <div class="current-id"></div>
                            <div class="row form-material">
                                <div class="col-lg-12 mb-3" id="no-polisi">
                                    <label class="text-label" for="no_polisi">No Polisi</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <select id="single-select" name="no_polisi" class="form-control no-polisi refresh-no-polisi" placeholder="Masukan No Polisi">
                                            <option value="">Pilih No Polisi</option>
                                            @foreach ($no_polisi as $row)
                                            <option value="{{ $row->id }}">{{ $row->no_polisi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3" id="current-no-polisi">

                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-row">
                                        <label class="text-label" for="merk">Merk</label>
                                        <input type="text" name="merk" id="merk" class="form-control" style="background-color: rgba(215, 218, 227, 0.3)" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-row">
                                        <label class="text-label" for="warna">Warna</label>
                                        <input type="text" name="warna" id="warna" class="form-control" style="background-color: rgba(215, 218, 227, 0.3)" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="tahun_pembuatan">Tahun Pembuatan</label>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="tahun_pembuatan" id="tahun_pembuatan" disabled style="background-color: rgba(215, 218, 227, 0.3)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="harga_beli">Harga Beli</label>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control money" name="harga_beli" id="harga_beli" style="background-color: rgba(215, 218, 227, 0.3)" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="nik">NIK</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-default" placeholder="Masukan No NIK KTP" name="nik" id="nik">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="nama_pembeli">Nama Pembeli</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukan Nama Pembeli">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="alamat">Alamat</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <textarea class="form-control input-default" rows="2" name="alamat" id="alamat" placeholder="Masukan Alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="alamat">Upload Foto KTP</label>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="photo-ktp" id="photo-ktp" onchange="previewImageKTP()">
                                                <label class="custom-file-label">Pilih Gambar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3 text-center" id="img-ktp">
                                    <img src="/storage/ktp/default.png" alt="" class="img-fluid" width="200px">
                                    <br>
                                    <input type="hidden" name="photo_ktp" id="photo_ktp">
                                    <input type="hidden" name="old_ktp" id="old_ktp">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="tanggal_jual">Tanggal Penjualan</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-default" placeholder="Masukan Tanggal Penjualan" name="tanggal_jual" id="tanggal_jual">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="jenis_pembayaran">Jenis Pembayaran</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-id-card"></i></span>
                                            </div>
                                            <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran">
                                                <option value="">Pilih Opsi Pembayaran</option>
                                                <option value="CASH">CASH</option>
                                                <option value="KREDIT">KREDIT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="buys-content-cash" class="row form-material d-none" style="padding-bottom: 92.75px">
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="harga_jual">Harga Jual</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" placeholder="Masukan Harga Jual" name="harga_jual" id="harga_jual">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="jumlah_bayar">Jumlah Bayar</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" placeholder="Masukan Jumlah Bayar" name="jumlah_bayar" id="jumlah_bayar">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="kembali">Kembalian</label>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" name="kembali" id="kembali" readonly style="background-color: rgba(215, 218, 227, 0.3)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="buys-content-kredit" class="row form-material d-none" style="padding-bottom: 92.75px">
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="tempat_lahir">Tempat Lahir</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-default" placeholder="Masukan Tempat Lahir" name="tempat_lahir" id="tempat_lahir">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="tanggal_lahir">Tanggal Lahir</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-default" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="jenis_kelamin">Jenis Kelamin</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="harga_jual_kredit">Harga Jual</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" placeholder="Masukan Harga Jual" name="harga_jual_kredit" id="harga_jual_kredit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="dp_bayar">DP Bayar</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" name="dp_bayar" id="dp_bayar" placeholder="Masukan DP Bayar">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="pencairan">Pencairan</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" name="pencairan" id="pencairan" placeholder=" Masukan Pencairan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="angsuran">Angsuran</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" name="angsuran" id="angsuran" placeholder="Masukan Angsuran">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="tenor">Tenor</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <input type="number" class="form-control input-default" placeholder="Masukan Jangka Waktu" name="tenor" id="tenor">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="text-label" for="komisi">Komisi</label><span class="text-danger"> *</span>
                                    <div class="form-row">
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" name="komisi" id="komisi" placeholder="Masukan Komisi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal"><span class="btn-icon-left text-danger"><i class="fa fa-close color-danger"></i>
                            </span>Tutup</button>
                        <div id="btn-action"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Transaksi Penjualan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTablesPenjualan" class="display min-w850 text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>No Polisi</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Harga Jual</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>No Polisi</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Harga Jual</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Transaksi Penjualan Kredit</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTablesPenjualanKredit" class="display min-w850 text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>No Polisi</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Harga Jual</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>No Polisi</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Harga Jual</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
{{-- Simple Money Format --}}
<script src="/js/simple.money.format.js"></script>
<script src="/js/simple.money.format.init.js"></script>
{{-- !Simple Money Format --}}
<script src="/js/page-script/penjualan.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const flashData = $('#pesan').data('flash');
    if (flashData) {
        Swal.fire(
            'Good job!', flashData, 'success'
        )
    }

</script>
@endsection
