@extends('layout.main')
@section('container')
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<div id="pesan" data-flash="{{ session('success') }}"></div>
<div class="row">
    <div class="col-xl-12">
        {{-- DATATABLE KREDIT --}}
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">

                </div>
                <!-- Title End -->

                <!-- Top Buttons Start -->
                <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">


                    <!-- Check Button Start -->
                    <div class="btn-group ms-1 check-all-container">

                    </div>
                    <!-- Check Button End -->
                </div>
                <!-- Top Buttons End -->
            </div>
        </div>
    </div>
</div>
<!-- Title and Top Buttons End -->

<!-- Content Start -->
<div class="data-table-boxed">
    <!-- Controls Start -->
    <div class="row mb-2">
        <!-- Search Start -->
        <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">

        </div>
        <!-- Search End -->

        <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
            <div class="d-inline-block me-0 me-sm-3 float-start float-md-none">


            </div>
            <div class="d-inline-block">
                <!-- Add New Button Start -->
                <button type="button" class="btn btn-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable-penjualanKredit" data-bs-toggle="modal" data-bs-target="#modal-transaksi" id="btn-add-data">
                    <i data-acorn-icon="plus" data-bs-toggle="tooltip" data-bs-placement="left" title="Tambah Data Penjualan Kredit"></i>
                </button>
                <button class="btn btn-icon btn-icon-only btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Tagihan" type="button">
                    <i data-acorn-icon="print"></i>
                </button>
                <button class="btn btn-icon btn-icon-only btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download PDF" type="button">
                    <i data-acorn-icon="download"></i>
                </button>
                <!-- Add New Button End -->


                <!-- Export Dropdown Start -->
                <div class="d-inline-block datatable-export" data-datatable="#datatableBoxed">

                </div>
                <!-- Export Dropdown End -->


            </div>
        </div>
    </div>
</div>
<!-- Controls End -->
<table id="datatableBoxed_penjualan_kredit" class="data-table nowrap hover" style="font-family: 'Nunito Sans', sans-serif; font-size: 0.9em ">
    <thead>
        <tr>
            <th class="text-muted text-small text-uppercase">No</th>
            <th class="text-muted text-small text-uppercase">Nama Pembeli</th>
            <th class="text-muted text-small text-uppercase">No Polisi</th>
            <th class="text-muted text-small text-uppercase">Merk</th>
            <th class="text-muted text-small text-uppercase">Warna</th>
            <th class="text-muted text-small text-uppercase">Harga Jual</th>
            <th class="text-muted text-small text-uppercase">Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<!-- Content End -->

<!-- Add Edit Modal Start -->
<div class="modal modal-center fade" id="modal-transaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" enctype="multipart/form-data" id="form-penjualan">
                    <div class="current-id"></div>
                    @csrf
                    <div class="form-floating mb-3 w-100">
                        <select id="no_polisi" name="no_polisi" class="form-control no-polisi" placeholder="Masukan No Polisi">
                            <option label="&nbsp;"></option>
                            @foreach ($no_polisi as $row)
                            <option value="{{ $row->id }}">{{ $row->no_polisi }}</option>
                            @endforeach
                        </select>
                        <label>No Polisi <span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3" id="current-no-polisi">


                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="merk" id="merk" class="form-control" style="background-color: rgba(215, 218, 227, 0.3)" disabled>
                        <label class="text-label" for="merk">Merk</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="warna" id="warna" class="form-control" style="background-color: rgba(215, 218, 227, 0.3)" disabled>
                        <label>Warna</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="tahun_pembuatan" id="tahun_pembuatan" disabled style="background-color: rgba(215, 218, 227, 0.3)">
                        <label for="tahun_pembuatan">Tahun Pembuatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="harga_beli" id="harga_beli" style="background-color: rgba(215, 218, 227, 0.3)" readonly>
                        <label for="harga_beli">Harga Beli</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control " placeholder="Masukan No NIK KTP" name="nik" id="nik">
                        <label class="text-label" for="nik">NIK<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukan Nama Pembeli">
                        <label class="text-label" for="nama_pembeli">Nama Pembeli<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control " rows="2" name="alamat" id="alamat" placeholder="Masukan Alamat"></textarea>
                        <label class="text-label" for="alamat">Alamat<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukan Nama Pembeli">
                        <label class="text-label" for="nama_pembeli">No HP<span class="text-danger"> *</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="photo-ktp" id="photo-ktp" onchange="previewImageKTP()">
                            <label class="input-group-text" for="photo-ktp">Upload Foto KTP</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="date-picker form-control" placeholder="Masukan Tanggal Penjualan" id="tanggal_jual" />
                        <label class="text-label" for="tanggal_jual">Tanggal Penjualan<span class="text-danger"> *</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir" id="tempat_lahir">
                        <label class="text-label" for="tempat_lahir">Tempat Lahir<span class="text-danger"> *</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="date-picker form-control" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir">
                        <label class="text-label" for="tanggal_lahir">Tanggal Lahir<span class="text-danger"> *</label></span>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <select id="jenis_kelamin" name="jenis_kelamin">
                            <option label="&nbsp;"></option>
                            <option value="COWO">Laki - Laki</option>
                            <option value="CEWE">Perempuan</option>
                        </select>
                        <label class="text-label" for="jenis_kelamin">Jenis Kelamin<span class="text-danger"> *</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="otr_leasing" id="otr_leasing" readonly style="">
                        <label class="text-label" for="otr_leasing">OTR Leasing</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="dp_po" id="dp_po" readonly style="">
                        <label class="text-label" for="dp_po">DP PO Leasing</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="dp_bayar" id="dp_bayar" readonly style="">
                        <label class="text-label" for="dp_bayar">DP Bayar Konsumen</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="pencairan" id="pencairan" readonly style="">
                        <label class="text-label" for="pencairan">Pencairan</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="angsuran" id="angsuran" readonly style="">
                        <label class="text-label" for="angsuran">Angsuran</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="tenor" id="tenor" readonly style="">
                        <label class="text-label" for="tenor">Tenor</label></span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control money" name="komisi" id="komisi" readonly style="">
                        <label class="text-label" for="komisi">Komisi TAC</label></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="addEditConfirmButton">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Edit Modal End -->
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
{{-- Simple Money Format --}}
<script src="/page-script/simple.money.format.js"></script>
<script src="/page-script/simple.money.format.init.js"></script>
{{-- !Simple Money Format --}}
<script src="/page-script/kredit.js"></script>
<script src="/page-script/penjualan.js"></script>
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
