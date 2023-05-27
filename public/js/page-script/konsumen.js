$(document).ready(function () {
    var table = $("#dataTables").DataTable({
        createdRow: function (row, data, index) {
            $(row).addClass("selected");
        },
        processing: true,
        responsive: true,
        searching: true,
        bLengthChange: true,
        info: false,
        ordering: true,
        serverSide: true,
        ajax: "/datatablesIndividu",
        // "columnDefs": [{
        //     "targets": [5], // index kolom atau sel yang ingin diatur
        //     "className": 'status-motor' // kelas CSS untuk memposisikan isi ke tengah
        // }],
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: "nama",
            },
            {
                data: "nik",
            },
            {
                data: "no_telepon",
            },
            {
                data: "alamat",
            },
            {
                data: "action",
            },
        ],
        order: [[0, "desc"]],
    });

    var table2 = $("#dataTables2").DataTable({
        createdRow: function (row, data, index) {
            $(row).addClass("selected");
        },
        processing: true,
        responsive: true,
        searching: true,
        bLengthChange: true,
        info: false,
        ordering: true,
        serverSide: true,
        ajax: "/datatablesDealer",
        // "columnDefs": [{
        //     "targets": [5], // index kolom atau sel yang ingin diatur
        //     "className": 'status-motor' // kelas CSS untuk memposisikan isi ke tengah
        // }],
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: "nama",
            },
            {
                data: "dealer",
            },
            {
                data: "action",
            },
        ],
        order: [[0, "desc"]],
    });

    let table3 = $("#dataTablesMotor").DataTable({
        processing: true,
        responsive: true,
        searching: true,
        bLengthChange: true,
        info: false,
        ordering: true,
        serverSide: true,
        ajax: {
            url: "/dataTablesMotor",
            type: "GET",
            data: function (d) {
                d.id = $("#data-motor").val();
            },
        },
        columnDefs: [
            {
                targets: [2], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
        ],
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: "merek",
            },
            {
                data: "no_polisi",
            },
            {
                data: "warna",
            },
            {
                data: "tanggal_beli",
            },
            {
                data: "harga_beli",
            },
        ],
    });
    //Memasukan Gambar Ke Modal
    $("#dataTables").on("click", ".info-button-ktp", function () {
        let ktp = $(this).attr("data-ktp");
        $("#modal-ktp .modal-body img").attr("src", "/storage/" + ktp);
        $("#modal-ktp").modal("show");
    });

    //Memasukan data individu ke modal
    $("#dataTables").on("click", ".info-button-individu", function () {
        document.getElementById("dataTablesMotor").style.width = "53vw";
        let id = $(this).attr("data-id");
        $("#data-motor").val(id);
        $("#modal-motor").modal("show");
        table3.ajax.reload();
    });
    $("#dataTables2").on("click", ".info-button-dealer", function () {
        document.getElementById("dataTablesMotor").style.width = "70vw";
        let id = $(this).attr("data-id");
        $("#data-motor").val(id);
        $("#modal-motor").modal("show");
        table3.ajax.reload();
    });

    $(".tab-comsumer").on("click", function () {
        document.getElementById("dataTables2").style.width = "70vw";
    });
});
