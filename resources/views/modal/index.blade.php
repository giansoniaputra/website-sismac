@extends('layout.main')
@section('container')
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<div id="pesan" data-flash="{{ session('success') }}"></div>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-rounded btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="btn-icon-left text-primary"><i class="fa fa-money color-primary"></i>
            </span>Set Modal Awal</button>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal-halaman-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Set Modal Awal</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form action="javascript:;">
                        @csrf
                        @method('put')
                        <input type="hidden" name="unique" id="unique" value="{{ $data->unique }}">
                        <div class="modal-body">
                            <div class="basic-form">
                                <label class="text-label" for="masukan_modal">Masukan Modal Awal</label>
                                <div class="form-row">
                                    <div class="input-group">
                                        <div class="input-group-append input-primary">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control input-default money" name="modal" id="modal" placeholder="" value="{{ $data->modal }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal"><span class="btn-icon-left text-danger"><i class="fa fa-close color-danger"></i>
                                </span>Tutup</button>
                            <button type="button" class="btn btn-rounded btn-primary" id="save-data-modal"><span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i>
                                </span>Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Modal</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 font-w600 text-white" id="refresh-modal">
                                            {{ rupiah($data->modal) }}</h2>
                                        <span class="text-white">Modal Awal</span>
                                    </div>
                                    <h1 class="la la-money-bill-wave text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 50%; height:4px;" role="progressbar">
                                    <span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2  col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 text-white font-w600" id="refresh-asset">
                                            {{ rupiah($bike_sele) }}</h2>
                                        <span class="text-white">Jumlah Asset</span>
                                    </div>
                                    <h1 class="la la-archive text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 90%; height:4px;" role="progressbar">
                                    <span class="sr-only">90% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2  col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 text-white font-w600" id="refresh-asset">{{ $jumlah_unit }}
                                            Unit</h2>
                                        <span class="text-white">Jumlah Unit</span>
                                    </div>
                                    <h1 class="la la-archive text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 90%; height:4px;" role="progressbar">
                                    <span class="sr-only">90% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2  col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 text-white font-w600" id="refresh-sisa">
                                            {{ rupiah($sisa_modal) }}</h2>
                                        <span class="text-white">Sisa Modal</span>
                                    </div>
                                    <h1 class="la la-money-bill-wave-alt text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 30%; height:4px;" role="progressbar">
                                    <span class="sr-only">30% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2  col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 text-white font-w600" id="refresh-laba">{{ rupiah($laba) }}
                                        </h2>
                                        <span class="text-white">Laba</span>
                                    </div>
                                    <h1 class="text-white">$</h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
                                    <span class="sr-only">94% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-2 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 font-w600 text-white" id="refresh-modal">
                                            {{ rupiah($data->modal + $laba) }}</h2>
                                        <span class="text-white">Modal + Laba</span>
                                    </div>
                                    <h1 class="la la-money-bill-wave text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 50%; height:4px;" role="progressbar">
                                    <span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 font-w600 text-white" id="refresh-modal">
                                            {{ $semua_unit }}</h2>
                                        <span class="text-white">Jumlah Stock Unit</span>
                                    </div>
                                    <h1 class="la la-money-bill-wave text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 50%; height:4px;" role="progressbar">
                                    <span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 font-w600 text-white" id="refresh-modal">
                                            {{ rupiah($sisa_bank) }}</h2>
                                        <span class="text-white">Saldo Bank</span>
                                    </div>
                                    <h1 class="la la-money-bill-wave text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 50%; height:4px;" role="progressbar">
                                    <span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3">
                                        <h2 class="fs-20 font-w600 text-white" id="refresh-modal">
                                            {{ rupiah($komisi) }}</h2>
                                        <span class="text-white">Komisi</span>
                                    </div>
                                    <h1 class="la la-money-bill-wave text-white"></h1>
                                </div>
                            </div>
                            <div class="progress  rounded-0" style="height:4px;">
                                <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 50%; height:4px;" role="progressbar">
                                    <span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Simple Money Format --}}
<script src="/js/simple.money.format.js"></script>
<script src="/js/simple.money.format.init.js"></script>
{{-- !Simple Money Format --}}
<script src="/js/page-script/modal.js"></script>
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
