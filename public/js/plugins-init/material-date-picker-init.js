(function ($) {
    "use strict";

    // MAterial Date picker
    $("#tanggal_lahir").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#tanggal_beli").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#tanggal_jual").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#berlaku_sampai").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#perpanjang_stnk").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#tahun_pembuatan").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#tanggal_perbaikan").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#laporan_pertahun").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#laporan_perbulan").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#laporan_perhari").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#laporan_pertanggal").bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
    });
    $("#timepicker").bootstrapMaterialDatePicker({
        format: "HH:mm",
        time: true,
        date: false,
    });
    $("#date-format").bootstrapMaterialDatePicker({
        format: "dddd DD MMMM YYYY - HH:mm",
    });

    $("#min-date").bootstrapMaterialDatePicker({
        format: "DD/MM/YYYY HH:mm",
        minDate: new Date(),
    });
})(jQuery);
