@extends('layout.main')
@section('container')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
<div id="pesan" data-flash="{{ session('error') }}"></div>
<div class="row">
    <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Pembelian</h4>
            </div>
            <div class="card-body">
                <div id="smartwizard" class="form-wizard order-create">
                    <ul class="nav nav-wizard">
                        <li><a class="nav-link link1" href="#data_konsumen">
                                <span>1</span>
                            </a></li>
                        <li><a class="nav-link link2" href="#data_motor">
                                <span>2</span>
                            </a></li>
                        <li><a class="nav-link link3" href="#harga">
                                <span>3</span>
                            </a></li>
                    </ul>
                    <div class="tab-content">
                        <form action="/pembelian/{{ $beli->unique }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row form-material">
                                <input type="hidden" name="oldImageBPKB" value="{{ $motor->photo_stnk }}">
                                <input type="hidden" name="oldImageSTNK" value="{{ $motor->photo_bpkb }}">
                                <input type="hidden" name="oldKTP" value="{{ $consumer->photo_ktp }}">
                            </div>
                            <div id="data_konsumen" class="tab-pane" role="tabpanel">
                                <input type="hidden" name="penjual" id="penjual" value="{{ $consumer->penjual }}">
                                @if ($consumer->penjual == 'INDIVIDU')
                                <div id="consumer-content-individu" style="padding-bottom: 92.75px">
                                    <div class="row form-material">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label" for="nik">NIK</label><span class="text-danger"> *</span>
                                                <input type="text" name="nik" id="nik" class="form-control input-default @error('nik')is-invalid @enderror" value="{{ old('nik', $consumer->nik) }}" placeholder="Masukan NIK">
                                                @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2 ">
                                            <div class="form-group">
                                                <label class="text-label" for="nama">Nama Lengkap</label><span class="text-danger"> *</span>
                                                <input type="text" name="nama" id="nama" class="form-control input-default @error('nama')is-invalid @enderror" value="{{ old('nama', $consumer->nama) }}" placeholder="Masukan Nama Lengkap">
                                                @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-material">
                                        <div class="col-lg-6 mb-5">
                                            <div class="form-group">
                                                <label class="text-label" for="no_telepon">Nomor Telepon</label><span class="text-danger"> *</span>
                                                <input class="form-control input-default @error('no_telepon')is-invalid @enderror" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $consumer->no_telepon) }}">
                                                @error('no_telepon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="form-group">
                                                <label class="text-label" for="alamat">Alamat</label><span class="text-danger"> *</span>
                                                <textarea class="form-control input-default @error('alamat')is-invalid @enderror" rows="2" name="alamat" id="alamat">{{ old('alamat', $consumer->alamat) }}</textarea>
                                                @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-material">
                                        <div class="col-lg-6 mb-2" style="padding-bottom:200px">
                                            <div class="form-group">
                                                <label class="text-label mb-3" for="photo_ktp">Foto KTP</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('photo_ktp')is-invalid @enderror" name="photo_ktp" name="photo_ktp" id="photo_ktp" onchange="previewImageKTP()">
                                                    <label class="custom-file-label">Pilih Gambar</label>
                                                    @error('photo_ktp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <img src="/storage/{{ old('oldKTP', $consumer->photo_ktp) }}" style="width: 250px" alt="" class="img-thumbnail mt-3 ml-5 image-ktp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($consumer->penjual == 'DEALER')
                                <div id="consumer-content-dealer">
                                    <div class="row form-material">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label" for="nama_kang">Nama Petugas</label><span class="text-danger"> *</span>
                                                <input type="text" name="nama_kang" id="nama_kang" class="form-control input-default @error('nama_kang')is-invalid @enderror" value="{{ old('nama_kang', $consumer->nama) }}" placeholder="Masukan Nama Petugas">
                                                @error('nama_kang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label" for="dealer">Nama Dealer</label><span class="text-danger"> *</span>
                                                <input type="text" name="dealer" id="dealer" class="form-control input-default @error('dealer')is-invalid @enderror" value="{{ old('dealer', $consumer->dealer) }}" placeholder="Masukan Nama Dealer">
                                                @error('dealer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div id="data_motor" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="merek">Merk</label><span class="text-danger"> *</span>
                                            <input type="text" name="merek" id="merek" class="form-control input-default @error('merek')is-invalid @enderror" value="{{ old('merek', $motor->merek) }}" placeholder="Masukan Merk">
                                            @error('merek')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="type">Tipe</label><span class="text-danger"> *</span>
                                            <input type="text" name="type" id="type" class="form-control input-default @error('type')is-invalid @enderror" value="{{ old('type', $motor->type) }}" placeholder="Masukan Tipe">
                                            @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="tahun_pembuatan">Tahun Pembuatan</label><span class="text-danger"> *</span>
                                            <input type="text" name="tahun_pembuatan" class="form-control input-default @error('tahun_pembuatan') is-invalid @enderror" placeholder="Masukan Tahun Pembuatan" value="{{ old('tahun_pembuatan', $motor->tahun_pembuatan) }}">
                                            @error('tahun_pembuatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="warna">Warna</label><span class="text-danger"> *</span>
                                            <input type="text" name="warna" id="warna" class="form-control input-default @error('warna')is-invalid @enderror" value="{{ old('warna', $motor->warna) }}" placeholder="Masukan Warna">
                                            @error('warna')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="no_rangka">No Rangka</label><span class="text-danger"> *</span>
                                            <input type="text" name="no_rangka" id="no_rangka" class="form-control input-default @error('no_rangka')is-invalid @enderror" value="{{ old('no_rangka', $motor->no_rangka) }}" placeholder="Masukan No Rangka">
                                            @error('no_rangka')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="no_polisi">No Polisi</label><span class="text-danger"> *</span>
                                            <input type="text" name="no_polisi" id="no_polisi" class="form-control input-default @error('no_polisi')is-invalid @enderror" value="{{ old('no_polisi', $motor->no_polisi) }}" placeholder="Masukan No Polisi">
                                            @error('no_polisi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="bpkb">No. BPKB</label><span class="text-danger"> *</span>
                                            <input type="text" name="bpkb" id="bpkb" class="form-control input-default @error('bpkb')is-invalid @enderror" value="{{ old('bpkb', $motor->bpkb) }}" placeholder="Masukan BPKB">
                                            @error('bpkb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label class="text-label" for="nama_bpkb">Nama BPKB</label><span class="text-danger"> *</span>
                                            <input type="text" name="nama_bpkb" id="nama_bpkb" class="form-control input-default @error('nama_bpkb')is-invalid @enderror" value="{{ old('nama_bpkb', $motor->nama_bpkb) }}" placeholder="Masukan BPKB">
                                            @error('nama_bpkb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label class="text-label" for="berlaku_sampai">Berlaku Sampai</label><span class="text-danger"> *</span>
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-default @error('berlaku_sampai')is-invalid @enderror" value="{{ old('berlaku_sampai', $motor->berlaku_sampai) }}" placeholder="Masukan Masa Berlaku" name="berlaku_sampai" id="berlaku_sampai">
                                            @error('berlaku_sampai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label class="text-label" for="perpanjang_stnk">Perpanjang STNK</label><span class="text-danger"> *</span>
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-default @error('perpanjang_stnk')is-invalid @enderror" value="{{ old('perpanjang_stnk', $motor->perpanjang_stnk) }}" placeholder="Masukan Masa Berlaku" name="perpanjang_stnk" id="perpanjang_stnk">
                                            @error('perpanjang_stnk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2" style="padding-bottom:300px">
                                        <div class="form-group">
                                            <label class="text-label mb-3" for="photo_stnk">Foto STNK</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('photo_stnk')is-invalid @enderror" value="{{ old('photo_stnk') }}" name="photo_stnk" id="photo_stnk" onchange="previewImageSTNK()">
                                                <label class="custom-file-label">Pilih Gambar</label>
                                                @error('photo_stnk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <img src="/storage/{{ $motor->photo_stnk }}" style="width: 250px" alt="" class="img-thumbnail mt-3 ml-5 image-stnk">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2" style="padding-bottom:300px">
                                        <div class="form-group">
                                            <label class="text-label mb-3" for="photo_bpkb">Foto BPKB</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('photo_bpkb')is-invalid @enderror" value="{{ old('photo_bpkb') }}" name="photo_bpkb" name="photo_bpkb" id="photo_bpkb" onchange="previewImageBPKB()">
                                                <label class="custom-file-label">Pilih Gambar</label>
                                                @error('photo_bpkb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <img src="/storage/{{ $motor->photo_bpkb }}" style="width: 250px" alt="" class="img-thumbnail mt-3 ml-5 image-bpkb">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="harga" class="tab-pane" role="tabpanel">
                                <div class="row form-material">
                                    <div class="col-lg-6 mb-2">
                                        <label class="text-label" for="harga_beli">Harga Beli</label><span class="text-danger"> *</span>
                                        <div class="form-row">
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-append input-primary">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control money input-default @error('harga_beli')is-invalid @enderror" value="{{ old('harga_beli', $beli->harga_beli) }}" placeholder="Masukan Harga Beli" name="harga_beli" id="harga_beli">
                                                @error('harga_beli')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label class="text-label" for="tanggal_beli">Tanggal Pembelian</label><span class="text-danger"> *</span>
                                        <div class="form-row">
                                            <div class="input-group mb-3 col-sm-12">
                                                <div class="input-group-append input-primary">
                                                    <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-default @error('tanggal_beli')is-invalid @enderror" value="{{ old('tanggal_beli', $beli->tanggal_beli) }}" placeholder="Masukan Tanggal Pembelian" name="tanggal_beli" id="tanggal_beli">
                                                @error('tanggal_beli')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <button type="submit" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-primary"><i class="flaticon-381-edit-1 color-primary"></i>
                                            </span>Edit Data Pembelian</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
<script src="/js/page-script/pembelian.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const flashData = $("#pesan").data("flash");
    if (flashData) {
        Swal.fire({
            icon: 'error'
            , title: 'Oops...'
            , text: flashData
        , })
    }

</script>
@endsection
