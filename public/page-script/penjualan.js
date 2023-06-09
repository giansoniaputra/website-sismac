$(document).ready(function () {
    let table = $("#datatableBoxed_penjualan_cash").DataTable({
        processing: true,
        responsive: true,
        searching: true,
        info: false,
        ordering: true,
        serverSide: true,
        ajax: "/dataTablesPenjualan",
        dom: '<"row"<"col-sm-12"<"table-container"<"card-body half-padding"f><"card"<"card-body half-padding"t>>>>><"row"<"col-12 mt-3"p>>', // Hiding all other dom elements except table and pagination
        lengthMenu: [10, 25, 50, 100], // Menampilkan opsi jumlah record yang ingin ditampilkan
        pageLength: 15, // Jumlah record yang ditampilkan secara default,
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#datatableBoxed_penjualan_cash")
                        .DataTable()
                        .page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "nama",
            },
            {
                data: "no_polisi",
            },
            {
                data: "merek",
            },
            {
                data: "warna",
            },
            {
                data: "harga_jual",
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [6], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                targets: [0], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
        order: [[0, "asc"]],
        language: {
            paginate: {
                previous: '<i class="cs-chevron-left"></i>',
                next: '<i class="cs-chevron-right"></i>',
            },
        },
    });

    //Ketika no pilisi diilih
    $(".no-polisi").on("change", function () {
        let id = $(this).val();
        $(this).removeClass("is-invalid");
        $.ajax({
            data: {
                id: id,
            },
            url: "/getDataMotor",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $("#merk").val(response.success.merek);
                $("#warna").val(response.success.warna);
                $("#tahun_pembuatan").val(response.success.tahun_pembuatan);
                $("#harga_beli").val(response.success.harga_beli);
                $("input.money").simpleMoneyFormat({
                    currencySymbol: "Rp",
                    decimalPlaces: 0,
                    thousandsSeparator: ".",
                });
            },
        });
    });
    //Reset ketika modal di tutup
    $(".btn-close").on("click", function () {
        $("#merk").val("");
        $("#warna").val("");
        $("#tahun_pembuatan").val("");
        $("#harga_beli").val("");
        $(".no-polisi").val(null).trigger("change");
        $("#current-no-polisi").html("");
        $("#no-polisi").removeClass("d-none");
        $("#harga_jual").val("");
        $("#nik").val("");
        $("#old_ktp").val("");
        $("#photo_ktp").val("");
        $("#nama_pembeli").val("");
        $("#tanggal_jual").val("");
        $("#modal-transaksi #alamat").val("");
        $("#harga_jual").removeClass("is-invalid");
        $(".current-id").html("");
        $("#photo_ktp").html("");
        $("#photo-ktp").val("");
        $("#photo-ktp").next(".custom-file-label").html("Pilih gambar");
        $("#img-ktp img").attr("src", "/storage/ktp/default.png");
    });
    //Reset ketika tombol tutup di click
    $(".modal-footer").on("click", ".btn-outline-primary", function () {
        $("#merk").val("");
        $("#warna").val("");
        $("#tahun_pembuatan").val("");
        $("#harga_beli").val("");
        $(".no-polisi").val(null).trigger("change");
        $("#current-no-polisi").html("");
        $("#no-polisi").removeClass("d-none");
        $("#harga_jual").val("");
        $("#nik").val("");
        $("#old_ktp").val("");
        $("#photo_ktp").val("");
        $("#nama_pembeli").val("");
        $("#tanggal_jual").val("");
        $("#modal-transaksi #alamat").val("");
        $("#harga_jual").removeClass("is-invalid");
        $(".current-id").html("");
        $("#photo_ktp").html("");
        $("#photo-ktp").val("");
        $("#photo-ktp").next(".custom-file-label").html("Pilih gambar");
        $("#img-ktp img").attr("src", "/storage/ktp/default.png");
    });
    //Ketika NIK terdaftar di table
    $("#nik").on("keyup", function () {
        NProgress.start();
        let nik = $(this).val();
        $.ajax({
            data: {
                nik: nik,
            },
            url: "/cekNikPembeli",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#nama_pembeli").val(response.success.nama);
                    $("#alamat").html(response.success.alamat);
                    $("#nama_pembeli").css({
                        "background-color": "rgba(215, 218, 227, 0.3)",
                    });
                    $("#alamat").css({
                        "background-color": "rgba(215, 218, 227, 0.3)",
                    });
                    $("#nama_pembeli").removeClass("is-invalid");
                    $("#alamat").removeClass("is-invalid");
                    if (response.success.photo_ktp == null) {
                        $("#img-ktp img").attr(
                            "src",
                            "/storage/ktp/default.png"
                        );
                    } else {
                        $("#img-ktp img").attr(
                            "src",
                            "/storage/ktp_pembeli/" + response.success.photo_ktp
                        );
                    }
                    NProgress.done();
                } else {
                    $("#nama_pembeli").val("");
                    $("#modal-transaksi #alamat").html("");
                    $("#nama_pembeli").removeAttr("style");
                    $("#alamat").removeAttr("style");
                    $("#img-ktp img").attr("src", "/storage/ktp/default.png");
                    NProgress.done();
                }
            },
        });
    });
    //Ketika menekan tombol tambah data penjualan
    $("#btn-add-data").on("click", function () {
        let element =
            ' <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-primary save-data" id="addEditConfirmButton" title="Tambah">Tambah</button>';
        $("#btn-action").html(element);
        $(".current-id").html("");
    });
    //Action Simpan Penjualan
    $("#modal-transaksi").on("click", ".save-data", function () {
        let formdata = $("#modal-transaksi form").serializeArray();
        let data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $("#modal-transaksi form").serialize(),
            url: "/tambahPenjualan",
            type: "POST",
            dataType: "json",
            success: function (response) {
                // console.log(response.image);
                if (
                    response.errors ||
                    response.error_ktp ||
                    response.error_ktp_type
                ) {
                    displayErrors(response.errors);
                    if (response.error_ktp) {
                        let inputElement = $('input[name="photo_ktp"]');
                        let inputElement2 = $('input[name="photo-ktp"]');
                        inputElement2.addClass("is-invalid");
                        inputElement.addClass("is-invalid");
                        let feedbackElement = $(
                            '<div class="invalid-feedback ml-2 photo-ktp-error">' +
                                response.error_ktp.photo_ktp +
                                "</div>"
                        );
                        inputElement.after(feedbackElement);
                    }
                    if (response.error_ktp_type) {
                        let inputElement2 = $('input[name="photo-ktp"]');
                        inputElement2.addClass("is-invalid");
                        let inputElement = $('input[name="photo_ktp"]');
                        inputElement.addClass("is-invalid");
                        let feedbackElement = $(
                            '<div class="invalid-feedback ml-2 photo-ktp-error-file">' +
                                response.error_ktp_type +
                                "</div>"
                        );
                        inputElement.after(feedbackElement);
                    }
                } else if (response.success) {
                    $("#merk").val("");
                    $("#warna").val("");
                    $("#tahun_pembuatan").val("");
                    $("#harga_beli").val("");
                    $(".no-polisi").val(null).trigger("change");
                    $("#current-no-polisi").html("");
                    $("#no-polisi").removeClass("d-none");
                    $("#harga_jual").val("");
                    $("#nik").val("");
                    $("#old_ktp").val("");
                    $("#photo_ktp").val("");
                    $("#nama_pembeli").val("");
                    $("#tanggal_jual").val("");
                    $("#modal-transaksi #alamat").val("");
                    $("#harga_jual").removeClass("is-invalid");
                    $(".current-id").html("");
                    $("#photo_ktp").html("");
                    $("#photo-ktp").val("");
                    $("#modal-transaksi").modal("hide");
                    $("#photo-ktp")
                        .next(".custom-file-label")
                        .html("Pilih gambar");
                    $("#img-ktp img").attr("src", "/storage/ktp/default.png");

                    Swal.fire("Good job!", response.success, "success");
                    table.ajax.reload();
                }
            },
        });
    });
    //Action Simpan Penjualan Kredit
    $("#modal-transaksi").on("click", ".save-data-kredit", function () {
        let formdata = $("#modal-transaksi form").serializeArray();
        let data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        //JIka Pembayaran adalah Cash
        $.ajax({
            data: $("#modal-transaksi form").serialize(),
            url: "/kredit",
            type: "POST",
            dataType: "json",
            success: function (response) {
                // console.log(response);
                //     // console.log(response.image);
                if (
                    response.errors ||
                    response.error ||
                    response.error_ktp ||
                    response.error_ktp_type
                ) {
                    displayErrors(response.errors);
                    if (response.error) {
                        let inputElement = $('input[name="jumlah_bayar"]');
                        inputElement.addClass("is-invalid");
                        let feedbackElement = $(
                            '<div class="invalid-feedback ml-2 jumlah_bayar">' +
                                response.error +
                                "</div>"
                        );
                        inputElement.after(feedbackElement);
                    }
                    if (response.error_ktp) {
                        let inputElement = $('input[name="photo_ktp"]');
                        let inputElement2 = $('input[name="photo-ktp"]');
                        inputElement2.addClass("is-invalid");
                        inputElement.addClass("is-invalid");
                        let feedbackElement = $(
                            '<div class="invalid-feedback ml-2 photo-ktp-error">' +
                                response.error_ktp.photo_ktp +
                                "</div>"
                        );
                        inputElement.after(feedbackElement);
                    }
                    if (response.error_ktp_type) {
                        let inputElement2 = $('input[name="photo-ktp"]');
                        inputElement2.addClass("is-invalid");
                        let inputElement = $('input[name="photo_ktp"]');
                        inputElement.addClass("is-invalid");
                        let feedbackElement = $(
                            '<div class="invalid-feedback ml-2 photo-ktp-error-file">' +
                                response.error_ktp_type +
                                "</div>"
                        );
                        inputElement.after(feedbackElement);
                    }
                } else if (response.success) {
                    $("#merk").val("");
                    $("#warna").val("");
                    $("#tahun_pembuatan").val("");
                    $("#harga_beli").val("");
                    $(".no-polisi").val(null).trigger("change");
                    $("#current-no-polisi").html("");
                    $("#no-polisi").removeClass("d-none");
                    $("#jenis_pembayaran").val("");
                    $("#jenis_pembayaran").removeAttr("disabled style");
                    $("#buys-content-cash").addClass("d-none");
                    $("#harga_jual").val("");
                    $("#jumlah_bayar").val("");
                    $("#nik").val("");
                    $("#kembali").val("");
                    $("#nama_pembeli").val("");
                    $("#tanggal_jual").val("");
                    $("#harga_jual").removeClass("is-invalid");
                    $("#jumlah_bayar").removeClass("is-invalid");
                    $("#photo-ktp").val("");
                    $("#photo-ktp")
                        .next(".custom-file-label")
                        .html("Pilih gambar");
                    $(".current-id").html("");
                    $("#modal-transaksi #alamat").html("");
                    $("#photo_ktp").val("");
                    $("#img-ktp img").attr("src", "/storage/ktp/default.png");
                    $("#save-data").removeClass("save-data-cash");
                    $("#save-data").removeClass("save-data-kredit");
                    $("#save-data").addClass("save-data");
                    $("#modal-transaksi").modal("hide");
                    Swal.fire("Good job!", response.success, "success");
                    table.ajax.reload();
                }
            },
        });
    });
    //Ambil data penjualan yanag ingin di edit
    $("#datatableBoxed_penjualan_cash").on(
        "click",
        ".edit-button",
        function () {
            let id = $(this).attr("data-id");
            $(".current-id").html(
                '<input type="hidden" name="current_id" value="' + id + '">'
            );
            $.ajax({
                data: {
                    id: id,
                },
                url: "/ambilDataPenjualan",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    let elementNoPolisi =
                        '<input type="hidden" name="curent_no_polisi" id="curent_no_polisi" class="form-control" style="background-color: rgba(215, 218, 227, 0.3)" value="' +
                        response.data.no_polisi +
                        '" disabled><label class="text-label" for="curent_no_polisi">Merk</label>';
                    $("#current-no-polisi").html(elementNoPolisi);
                    $("#no-polisi").addClass("d-none");
                    $("#modal-transaksi").modal("show");
                    $(".no-polisi").val(response.data.bike_id);
                    $("#nama_pembeli").val(response.data.pembeli);
                    $("#merk").val(response.data.merek);
                    $("#warna").val(response.data.warna);
                    $("#tahun_pembuatan").val(response.data.tahun_pembuatan);
                    $("#harga_beli").val(response.data.harga_beli);
                    $("#tanggal_jual").val(response.data.tanggal_jual);
                    $("#nik").val(response.data.nik);
                    $("#nama_pembeli").val(response.data.nama);
                    $("#alamat").val(response.data.alamat);
                    $("#old_ktp").val("ktp_pembeli/" + response.data.photo_ktp);
                    if (response.data.photo_ktp == null) {
                        $("#img-ktp img").attr(
                            "src",
                            "/storage/ktp/default.png"
                        );
                    } else {
                        $("#img-ktp img").attr(
                            "src",
                            "/storage/ktp_pembeli/" + response.data.photo_ktp
                        );
                    }
                    $("#harga_jual").val(response.data.harga_jual);
                    $("input.money").simpleMoneyFormat({
                        currencySymbol: "Rp",
                        decimalPlaces: 0,
                        thousandsSeparator: ".",
                    });

                    //Menganti Button Action
                    let element =
                        '<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-primary update-data" id="addEditConfirmButton" title="Ubah">Ubah</button>';
                    $("#btn-action").html(element);
                },
            });
        }
    );
    //Action Update
    $("#modal-transaksi").on("click", ".update-data", function () {
        let formdata = $("#modal-transaksi form").serializeArray();
        let data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $("#modal-transaksi form").serialize(),
            url: "/updatePenjualan",
            type: "POST",
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.errors) {
                    displayErrors(response.errors);
                } else if (response.success) {
                    $("#modal-transaksi").modal("hide");
                    Swal.fire("Good job!", response.success, "success");
                    table.ajax.reload();
                    $("#merk").val("");
                    $("#warna").val("");
                    $("#tahun_pembuatan").val("");
                    $("#harga_beli").val("");
                    $(".no-polisi").val(null).trigger("change");
                    $("#current-no-polisi").html("");
                    $("#no-polisi").removeClass("d-none");
                    $("#jenis_pembayaran").val("");
                    $("#jenis_pembayaran").removeAttr("disabled style");
                    $("#buys-content-cash").addClass("d-none");
                    $("#harga_jual").val("");
                    $("#photo_ktp").val("");
                    $("#jumlah_bayar").val("");
                    $("#old_ktp").val("");
                    $("#nik").val("");
                    $("#kembali").val("");
                    $("#nama_pembeli").val("");
                    $("#tanggal_jual").val("");
                    $("#modal-transaksi #alamat").html("");
                    $("#photo-ktp").val("");
                    $("#photo-ktp")
                        .next(".custom-file-label")
                        .html("Pilih gambar");
                    $("#harga_jual").removeClass("is-invalid");
                    $("#jumlah_bayar").removeClass("is-invalid");
                    $(".current-id").html("");
                    $("#photo_ktp").html("");
                    $("#img-ktp img").attr("src", "/storage/ktp/default.png");

                    $("#save-data").removeClass("save-data-cash");
                    $("#save-data").removeClass("save-data-kredit");
                    $("#save-data").addClass("save-data");
                }
            },
        });
    });
    //Action Retur
    $("#dataTablesPenjualan").on("click", ".retur-button", function () {
        let unique = $(this).attr("data-id");
        Swal.fire({
            title: "Yakin ingin meretur penjualan?",
            text: "Anda akan meretur penjualan motor",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Retur!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = "/returMotor/" + unique;
            }
        });
    });
    // //Action Retur
    // $("#dataTablesPenjualan").on("click", ".retur-button", function () {
    //     let id = $(this).attr("data-id");
    //     let token = $(this).attr("data-token");
    //     Swal.fire({
    //         title: "Yakin ingin meretur penjualan?",
    //         text: "Anda akan meretur penjualan motor",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Ya, Retur!",
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 data: {
    //                     id: id,
    //                     _token: token,
    //                 },
    //                 url: "/returMotor",
    //                 type: "POST",
    //                 dataType: "json",
    //                 success: function (response) {
    //                     table.ajax.reload();
    //                     Swal.fire("Succeess!", response.success, "success");
    //                 },
    //             });
    //         }
    //     });
    // });
    //Hendler Error
    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $("input.form-control").removeClass("is-invalid");
        $("select.form-control").removeClass("is-invalid");
        $("div.invalid-feedback").each(function () {
            $("div.invalid-feedback").remove();
        });

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            let inputElement = $("input[name=" + field + "]");
            let selectElement = $("select[name=" + field + "]");
            let textAreaElement = $("textarea[name=" + field + "]");
            let feedbackElement = $(
                '<div class="invalid-feedback ml-2"></div>'
            );

            $.each(messages, function (index, message) {
                feedbackElement.append(
                    $('<p class="p-0 m-0 text-center">' + message + "</p>")
                );
            });

            if (inputElement.length > 0) {
                inputElement.addClass("is-invalid");
                inputElement.after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass("is-invalid");
                selectElement.after(feedbackElement);
            }
            if (textAreaElement.length > 0) {
                textAreaElement.addClass("is-invalid");
                textAreaElement.after(feedbackElement);
            }
            inputElement.each(function () {
                if (inputElement.attr("type") == "text") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "date") {
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                }
            });
            textAreaElement.each(function () {
                textAreaElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
            selectElement.each(function () {
                selectElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
        });
    }
    //Autofill Kembalian
    $("#jumlah_bayar").on("keyup", function () {
        let jual = $("#harga_jual").val();
        let bayar = $(this).val();
        jual = jual.replace(/,/g, "");
        bayar = bayar.replace(/,/g, "");
        if (bayar - jual < "0") {
            $("#kembali").val("");
        } else if (bayar - jual == "0") {
            $("#kembali").val("0");
        } else {
            $("#kembali").val(bayar - jual);
            $("input.money").simpleMoneyFormat({
                currencySymbol: "Rp",
                decimalPlaces: 0,
                thousandsSeparator: ".",
            });
        }
    });
    $("#harga_jual").on("keyup", function () {
        let jual = $("#harga_jual").val();
        let bayar = $(this).val();
        jual = jual.replace(/,/g, "");
        bayar = bayar.replace(/,/g, "");
        if (bayar - jual < "0") {
            $("#kembali").val("");
        } else if (bayar - jual == "0") {
            $("#kembali").val("0");
        } else {
            $("#kembali").val(bayar - jual);
            $("input.money").simpleMoneyFormat({
                currencySymbol: "Rp",
                decimalPlaces: 0,
                thousandsSeparator: ".",
            });
        }
    });
    //Reset
    $("#harga_jual").on("click", function () {
        $(this).removeClass("is-invalid");
    });
    $("#tanggal_jual").on("change", function () {
        $("#tanggal_jual").removeClass("is-invalid");
    });
    $("#jumlah_bayar").on("click", function () {
        $(this).removeClass("is-invalid");
        $(".jumlah_bayar").remove();
    });
    //Hendler Icon Material Date Time
    let monthBefore = $(".dtp-select-month-before .material-icons");
    monthBefore.addClass("fa fa-arrow-left fa-lg text-white");
    monthBefore.removeClass("material-icons");
    monthBefore.html("");

    let yearBefore = $(".dtp-select-year-before .material-icons");
    yearBefore.addClass("fa fa-arrow-left fa-lg text-white");
    yearBefore.removeClass("material-icons");
    yearBefore.html("");

    let monthAfter = $(".dtp-select-month-after .material-icons");
    monthAfter.addClass("fa fa-arrow-right fa-lg text-white");
    monthAfter.removeClass("material-icons");
    monthAfter.html("");

    let yearAfter = $(".dtp-select-year-after .material-icons");
    yearAfter.addClass("fa fa-arrow-right fa-lg text-white");
    yearAfter.removeClass("material-icons");
    yearAfter.html("");

    let yearRangeBefore = $(".dtp-select-year-range.before .material-icons");
    yearRangeBefore.addClass("fa fa-arrow-up fa-lg text-dark");
    yearRangeBefore.removeClass("material-icons");
    yearRangeBefore.html("");

    let yearRangeAfter = $(".dtp-select-year-range.after .material-icons");
    yearRangeAfter.addClass("fa fa-arrow-down fa-lg text-dark");
    yearRangeAfter.removeClass("material-icons");
    yearRangeAfter.html("");
});

//Show Gambar KTP
function previewImageKTP() {
    document.getElementById("photo_ktp").classList.remove("is-invalid");
    document.getElementById("photo-ktp").classList.remove("is-invalid");
    const image = document.querySelector("#photo-ktp");
    const imgPre = document.querySelector("#img-ktp img");
    const photo_ktp = document.querySelector("#photo_ktp");

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPre.src = oFREvent.target.result;
        photo_ktp.value = oFREvent.target.result;
    };
}
