$(function () {
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#reportrange span").html(
            start.format("YYYY, MMMM D ") + " - " + end.format("YYYY, MMMM D")
        );
    }

    $("#reportrange").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Hoy: [moment(), moment()],
                Ayer: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Ultimos 7 Dias": [moment().subtract(6, "days"), moment()],
                "Ultimos 30 Dias": [moment().subtract(29, "days"), moment()],
                "Este Mes": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Mes Pasado": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);
});
