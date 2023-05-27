@extends('layout.main')
@section('container')
    <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title data-pelanggan">Detail Setting</h4>
                </div>
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12">
                        <div class="basic-form mt-3">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label mt-3">Nama Toko</label>
                                    <div class="col-sm-9 mb-5">
                                        <input type="text" class="form-control input-default" placeholder="">
                                    </div>
                                </div>
                                <div class="basic-form custom_file_input mb-5">
                                    <form action="#">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Edit Logo Full</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('photo_pria') is-invalid @enderror"
                                                    name="photo_pria" id="photo_pria">
                                                <input type="hidden" name="fotoPria" id="fotoPria"
                                                    value="{{ old('fotoPria') }}">
                                                @error('photo_pria')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <label class="custom-file-label">Pilih Gambar</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-primary"><span
                                                class="btn-icon-left text-primary"><i
                                                    class="flaticon-381-edit-1 color-primary"></i>
                                            </span>Edit Setting</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Cropper -->
    <div class="modal fade" id="modal-cropper" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cropper</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <img id="image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary crop-logo-full">Crop</button>
                </div>
            </div>
        </div>
        <script src="/js/page-script/logo.js"></script>
    @endsection
