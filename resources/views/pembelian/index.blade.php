@extends('layout.main')
@section('container')
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<div id="pesan" data-flash="{{ session('success') }}"></div>
<div class="col-12">
    @if ($modal->modal==0)
    <button type="button" class="btn btn-rounded btn-primary mb-3" id="button-no-modal"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i>
        </span>Tambah Data Penjualan</button>
    @else
    <a href="/pembelian/create" class="btn btn-rounded btn-primary mb-3"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i>
        </span>Tambah Data Pembelian</a>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Transaksi Pembelian</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTables" class="display min-w850 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Merk</th>
                            <th>No Polisi</th>
                            <th>Warna</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Beli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Merk</th>
                            <th>No Polisi</th>
                            <th>Warna</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Beli</th>
                            <th>Action</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
{{-- Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="accordion-two" class="accordion accordion-primary-solid">
                                <div class="accordion__item d-none" id="data-individu">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_collapseZero"> <span class="accordion__header--text text-white">Data Penjual</span>
                                        <span class="accordion__header--indicator"></span>
                                    </div>
                                    <div id="bordered_collapseZero" class="collapse accordion__body" data-parent="#accordion-two">
                                        <div class="accordion__body--text">
                                            <div class="table-responsive">
                                                <table class="table header-border table-responsive-sm table-striped" id="table_konsumen">
                                                    <tbody>
                                                        <tr>
                                                            <td>NIK</td>
                                                            <td>:</td>
                                                            <td><span id="nik"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td>:</td>
                                                            <td><span id="nama"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nomor Telepon</td>
                                                            <td>:</td>
                                                            <td><span id="no-telepon"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td><span id="alamat"></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion__item d-none" id="data-dealer">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_collapseOne"> <span class="accordion__header--text text-white">Data Dealer</span>
                                        <span class="accordion__header--indicator"></span>
                                    </div>
                                    <div id="bordered_collapseOne" class="collapse accordion__body" data-parent="#accordion-two">
                                        <div class="accordion__body--text">
                                            <div class="table-responsive">
                                                <table class="table header-border table-responsive-sm table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Petugas</td>
                                                            <td>:</td>
                                                            <td><span id="nama-petugas"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Dealer</td>
                                                            <td>:</td>
                                                            <td><span id="dealer"></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion__item">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_collapseTwo"> <span class="accordion__header--text text-white">Data Motor</span>
                                        <span class="accordion__header--indicator"></span>
                                    </div>
                                    <div id="bordered_collapseTwo" class="collapse accordion__body" data-parent="#accordion-two">
                                        <div class="accordion__body--text">
                                            <div class="table-responsive">
                                                <table class="table header-border table-responsive-sm table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td>No Polisi</td>
                                                            <td>:</td>
                                                            <td><span id="no-polisi"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Merk</td>
                                                            <td>:</td>
                                                            <td><span id="merk"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tipe</td>
                                                            <td>:</td>
                                                            <td><span id="tipe"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Warna</td>
                                                            <td>:</td>
                                                            <td><span id="warna"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tahun Pembuatan</td>
                                                            <td>:</td>
                                                            <td><span id="tahun-pembuatan"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>No Rangka</td>
                                                            <td>:</td>
                                                            <td><span id="no-rangka"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nomor BPKB</td>
                                                            <td>:</td>
                                                            <td><span id="bpkb"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama BPKB</td>
                                                            <td>:</td>
                                                            <td><span id="nama-bpkb"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berlaku Sampai</td>
                                                            <td>:</td>
                                                            <td><span id="berlaku-sampai"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Perpanjang STNK</td>
                                                            <td>:</td>
                                                            <td><span id="perpanjang-stnk"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Foto BPKB</td>
                                                            <td>:</td>
                                                            <td><span id="foto-bpkb"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Foto STNK</td>
                                                            <td>:</td>
                                                            <td><span id="foto-stnk"></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion__item">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_collapseThree"> <span class="accordion__header--text text-white">Data Pembelian</span>
                                        <span class="accordion__header--indicator"></span>
                                    </div>
                                    <div id="bordered_collapseThree" class="collapse accordion__body" data-parent="#accordion-two">
                                        <div class="accordion__body--text">
                                            <div class="table-responsive">
                                                <table class="table header-border table-responsive-sm table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td>Tanggal Beli</td>
                                                            <td>:</td>
                                                            <td><span id="tanggal-beli"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Harga Beli</td>
                                                            <td>:</td>
                                                            <td><span id="harga-beli"></span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal"><span class="btn-icon-left text-danger"><i class="fa fa-close color-danger"></i>
                        </span>Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Gambar --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-image">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header primary">
                <h5 class="modal-title text-black" id="judul-modal-photo"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="img-photo" class="d-flex justify-content-center align-items-center"></div>
            </div>
        </div>
    </div>
</div>
<script src="/js/page-script/pembelian.js"></script>
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
