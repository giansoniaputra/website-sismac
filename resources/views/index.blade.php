@extends('layout.main')
@section('container')
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <div id="pesan" data-flash="{{ session('success') }}"></div>
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h2 class="fs-34 text-black font-w600">76</h2>
                            <span>Jumlah Asset</span>
                        </div>
                        <h1 class="flaticon-381-folder-5"></h1>
                    </div>
                </div>
                <div class="progress  rounded-0" style="height:4px;">
                    <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 50%; height:4px;"
                        role="progressbar">
                        <span class="sr-only">50% Complete</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3  col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h2 class="fs-34 text-black font-w600">124,551</h2>
                            <span>Penjualan Tahun Ini</span>
                        </div>
                        <h1 class="flaticon-381-calendar-6"></h1>
                    </div>
                </div>
                <div class="progress  rounded-0" style="height:4px;">
                    <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 90%; height:4px;"
                        role="progressbar">
                        <span class="sr-only">90% Complete</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3  col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h2 class="fs-34 text-black font-w600">442</h2>
                            <span>Penjualan Bulan Ini</span>
                        </div>
                        <h1 class="flaticon-381-calendar-7"></h1>
                    </div>
                </div>
                <div class="progress  rounded-0" style="height:4px;">
                    <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 30%; height:4px;"
                        role="progressbar">
                        <span class="sr-only">30% Complete</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3  col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body mr-3">
                            <h2 class="fs-34 text-black font-w600">$5,034</h2>
                            <span>Penjualan Hari Ini</span>
                        </div>
                        <h1 class="flaticon-381-calendar-3"></h1>
                    </div>
                </div>
                <div class="progress  rounded-0" style="height:4px;">
                    <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;"
                        role="progressbar">
                        <span class="sr-only">94% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
