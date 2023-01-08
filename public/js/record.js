$(document).ready(function () {
    $("#qtable").DataTable({
        ajax: {
            url: "/api/records/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [
            {
                extend: "pdf",
                className: "btn btn-success glyphicon glyphicon-file",
            },
            {
                extend: "excel",
                className: "btn btn-success glyphicon glyphicon-list-alt",
            },
             {
                text: "Create new record",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#qform").trigger("reset");
                    $("#recordModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "recordid",
            },
            {
                data: "instructor_id",
            },
            {
                data: "instrument_id",
            },
            {
                data: "recordDate",
            },
            {
                data: "fee",
            },
            {
                data: "comment",
            },
            {
                data: "damage_id",
            },
        ],
    });

    $("#xtable").DataTable({
        ajax: {
            url: "/api/records/all",
            dataSrc: "",
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [
            {
                extend: "pdf",
                className: "btn btn-success glyphicon glyphicon-file",
            },
            {
                extend: "excel",
                className: "btn btn-success glyphicon glyphicon-list-alt",
            },
             {
                text: "Create new record",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#qform").trigger("reset");
                    $("#recordModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "recordid",
            },
            {
                data: "instructor_name",
            },
            {
                data: "instrument_name",
            },
            {
                data: "recordDate",
            },
            {
                data: "fee",
            },
            {
                data: "comment",
            },
            {
                data: "damagetitle",
            },
        ],
    });

$("#recordSubmit").on("click", function (e) {
    e.preventDefault();
    var data = $("#qform")[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/record/store",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var $stable = $("#qtable").DataTable();
            $stable.row.add(data.record).draw(false);

            bootbox.alert("Record submitted!", function() {
                location.reload(true);
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});

});
