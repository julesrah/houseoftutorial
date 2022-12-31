$(document).ready(function () {
    $("#rtable").DataTable({
        ajax: {
            url: "/api/instruments/all",
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
                text: "Add Instrument",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#rform").trigger("reset");
                    $("#instrumentModal").modal("show");
                },
            },
        
        ],
        columns: [
            {
                data: "id",
            },
            {
                data: "name",
            },

            {
                data: "type",
            },
            {
                data: "description",
            },
            {
                data: "condition",
            },
            {
                data: null,
                render: function (data, type, row) {
                    console.log(data.imagePath)
                    return `<img src= "storage/${data.imagePath}" "height="125px" width="125px">`;
                },
            },
              {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn' id='editbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });

$("#instrumentSubmit").on("click", function (e) {
        
    e.preventDefault();
    var data = $("#rform")[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/instruments/store",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var $rtable = $("#rtable").DataTable();
            $rtable.row.add(data.instrument).draw(false);

            bootbox.alert("Instrument created!", function() {
                location.reload(true);
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//EDIT
$("#rtable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    $("#instrumentModal").modal("show");
    var id = $(this).data("id");

    $.ajax({
        type: "GET",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        url: "/api/instruments/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#type").val(data.type);
                $("#description").val(data.description);
                $("#condition").val(data.condition);
        },
        error: function (error) {
            console.log("error");
        },
    });
});


//instrument UPDATE
$("#instrumentUpdate").on("click", function (e) {
    e.preventDefault();
    var id = $("#id").val();
    var data = $("#rform")[0];
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }
    var table = $("#rtable").DataTable();
    console.log(id);

    $.ajax({
        type: "POST",
        url: "/api/instruments/" + id,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            // $("#instrumentModal").modal("hide");
            // table.ajax.reload();
            bootbox.alert("Instrument has been updated!", function() {
                $("#instrumentModal").modal("hide");
                table.ajax.reload();
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//DELETE
$("#mbody").on("click", ".deletebtn", function (e) {
    var id = $(this).data("id");
    var $tr = $(this).closest("tr");
    // var id = $(e.relatedTarget).attr('id');
    console.log(id);
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this instrument?",
        buttons: {
            confirm: {
                label: "Yes",
                className: "btn-success",
            },
            cancel: {
                label: "No",
                className: "btn-danger",
            },
        },
        callback: function (result) {
            if (result)
                $.ajax({
                    type: "DELETE",
                    url: "/api/instruments/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        
                        $tr.find("td").css('backgroundColor','hsl(0,100%,50%').fadeOut(2000, function () {
                            $tr.remove();
                        });
                        
                        
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
        },
    });
});


});