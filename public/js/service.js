$(document).ready(function () {
    $("#stable").DataTable({
        ajax: {
            url: "/api/services/all",
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
                text: "Add Service",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#sform").trigger("reset");
                    $("#serviceModal").modal("show");
                },
            },
        
        ],
        columns: [
            {
                data: "id",
            },
            {
                data: "instructor_id",
            },
            {
                data: "instrument_id",
            },
            {
                data: "servname",
            },
            {
                data: "eventStarts",
            },
            {
                data: "description",
            },
            {
                data: "price",
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

$("#serviceSubmit").on("click", function (e) {
        
    e.preventDefault();
    var data = $("#sform")[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/services/store",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var $stable = $("#stable").DataTable();
            $stable.row.add(data.service).draw(false);

            bootbox.alert("service created!", function() {
                location.reload(true);
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//EDIT
$("#stable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    $("#serviceModal").modal("show");
    var id = $(this).data("id");

    $.ajax({
        type: "GET",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        url: "/api/services/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
               $("#id").val(data.id);
               $("#instructor_id").val(data.instructor_id);
               $("#instrument_id").val(data.instrument_id);
               $("#servname").val(data.servname);
               $("#eventStarts").val(data.eventStarts);
               $("#description").val(data.description);
               $("#price").val(data.price);
        },
        error: function (error) {
            console.log("error");
        },
    });
});


//service UPDATE
$("#serviceUpdate").on("click", function (e) {
    e.preventDefault();
    var id = $("#id").val();
    var data = $("#sform")[0];
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }
    var table = $("#stable").DataTable();
    console.log(id);

    $.ajax({
        type: "POST",
        url: "/api/services/" + id,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("#serviceModal").modal("hide");
            table.ajax.reload();
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//DELETE
$("#sbody").on("click", ".deletebtn", function (e) {
    var id = $(this).data("id");
    var $tr = $(this).closest("tr");
    // var id = $(e.relatedTarget).attr('id');
    console.log(id);
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this service?",
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
                    url: "/api/services/" + id,
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