@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Motor</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tersedia"><i class="la la-check-circle mr-2"></i>
                                Tersedia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-terjual" data-toggle="tab" href="#terjual"><i class="la la-cart-arrow-down mr-2"></i>
                                Terjual</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tersedia" role="tabpanel">
                            <div class="pt-4">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="dataTables" class="display min-w850 text-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Polisi</th>
                                                    <th>Merk</th>
                                                    <th>Warna</th>
                                                    <th>Tahun Pembuatan</th>
                                                    <th>Harga Beli</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Polisi</th>
                                                    <th>Merk</th>
                                                    <th>Warna</th>
                                                    <th>Tahun Pembuatan</th>
                                                    <th>Harga Beli</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="terjual">
                            <div class="pt-4">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="dataTables2" class="display min-w850 text-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Polisi</th>
                                                    <th>Merk</th>
                                                    <th>Warna</th>
                                                    <th>Tahun Pembuatan</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Polisi</th>
                                                    <th>Merk</th>
                                                    <th>Warna</th>
                                                    <th>Tahun Pembuatan</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-detail-motor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Motor</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="accordion-two" class="accordion accordion-primary-solid">
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
                                                            <td>No. BPKB</td>
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
{{-- Modal --}}
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="modal-perbaikan-motor">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Maintenance Motor</h5>
                <button type="button" class="close btn-close-maintenance" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="javascript:;">
                @csrf
                <div class="modal-body p-1">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <input type="hidden" name="bike_id" id="bike_id" value="0">
                                    <input type="hidden" name="current_unique" id="current_unique">
                                    <div class="method"></div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label class="text-label" for="no_polisi">No Polisi</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control input-default" id="no_polisi" readonly style="background-color: rgba(215, 218, 227, 0.3)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label class="text-label" for="merek">Merk</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control input-default" id="merek" readonly style="background-color: rgba(215, 218, 227, 0.3)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <label class="text-label" for="harga_beli">Harga Beli</label>
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" name="harga_beli" id="harga_beli" readonly style="background-color: rgba(215, 218, 227, 0.3)">

                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <label class="text-label" for="jenis_perbaikan">Jenis Maintenance</label>
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="la la-screwdriver"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-default" placeholder="Masukan Jenis Maintenance" id="jenis_perbaikan" name="jenis_perbaikan">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <label class="text-label" for="tanggal_perbaikan">Tanggal
                                            Maintenance</label>
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text"><i class="flaticon-381-calendar-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-default" placeholder="Masukan Tanggal Penjualan" name="tanggal_perbaikan" id="tanggal_perbaikan">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <label class="text-label" for="biaya">Biaya</label>
                                        <div class="input-group">
                                            <div class="input-group-append input-primary">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" class="form-control input-default money" placeholder="Masukan Biaya" name="biaya" id="biaya">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="tab-pane fade show active" id="tersedia" role="tabpanel">
                            <div class="pt-4">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="dataTablesMaintenance" class="display min-w850 text-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Maintenance</th>
                                                    <th>Jenis Maintenance</th>
                                                    <th>Biaya</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Maintenance</th>
                                                    <th>Jenis Maintenance</th>
                                                    <th>Biaya</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </form>
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
{{-- Simple Money Format --}}
<script src="/js/simple.money.format.js"></script>
<script src="/js/simple.money.format.init.js"></script>
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
{{-- Simple Money Format --}}
<script src="/js/simple.money.format.js"></script>
<script src="/js/simple.money.format.init.js"></script>
{{-- !Simple Money Format --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script src="/js/page-script/motor.js"></script>
@endsection
