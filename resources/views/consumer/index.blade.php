@extends('layout.main')
@section('container')
<input type="hidden" value="0" id="data-motor">
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Konsumen</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#data_pelanggan"><i class="la la-users mr-2"></i>
                                Data Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tab-comsumer" data-toggle="tab" href="#data_dealer"><i class="la la-user-tie mr-2"></i>
                                Data
                                Dealer</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="data_pelanggan" role="tabpanel">
                            <div class="pt-4">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="dataTables" class="display min-w850 text-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>NIK</th>
                                                    <th>No Telepon</th>
                                                    <th>Alamat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>NIK</th>
                                                    <th>No Telepon</th>
                                                    <th>Alamat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data_dealer">
                            <div class="pt-4">
                                <div class="col-12">
                                    <div class="table-responsive col-lg-12">
                                        <table id="dataTables2" class="display min-w850 text-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Nama Dealer</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Nama Dealer</th>
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
<!-- Modal Riwayat -->
<div class="modal fade" id="modal-motor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-black" id="staticBackdropLabel">Data Penjualan Motor Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="table-responsive col-12">
                        <table id="dataTablesMotor" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>No Polisi</th>
                                    <th>Warna</th>
                                    <th>Tanggal Beli</th>
                                    <th>Harga Beli</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>No Polisi</th>
                                    <th>Warna</th>
                                    <th>Tanggal Beli</th>
                                    <th>Harga Beli</th>
                            </tfoot>
                        </table>
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
<!-- Modal Riwayat -->
<div class="modal fade" id="modal-ktp" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-black" id="staticBackdropLabel">Photo KTP Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="img-fluid" style="width: 800px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal"><span class="btn-icon-left text-danger"><i class="fa fa-close color-danger"></i>
                    </span>Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="/js/page-script/konsumen.js"></script>
@endsection
