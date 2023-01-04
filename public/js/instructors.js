$(document).ready(function () {
    $("#gtable").DataTable({
        ajax: {
            url: "/api/instructors/all",
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
                text: "Add Instructor",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#gform").trigger("reset");
                    $("#instructorModal").modal("show");
                },
            },
        
        ],
        columns: [
            {
                data: "id",
            },
            {
                data: "instructor_name",
            },
            {
                data: "specialty",
            },
            {
                data: "instructor_description",
            },
            {
                data: "status",
            },
            {
                data: "address",
            },
            {
                data: "phonenumber",
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


$("#instructorSubmit").on("click", function (e) {
    e.preventDefault();
    var data = $("#gform")[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/instructors/store",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var $gtable = $("#gtable").DataTable();
            $gtable.row.add(data.instructor).draw(false);

            bootbox.alert("Instructor created!", function() {
                location.reload(true);
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//EDIT
$("#gtable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    $("#instructorModal").modal("show");
    var id = $(this).data("id");

    $.ajax({
        type: "GET",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        url: "/api/instructors/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
                $("#id").val(data.id);
                $("#instructor_name").val(data.instructor_name);
                $("#specialty").val(data.specialty);
                $("#instructor_description").val(data.instructor_description);
                $("#status").val(data.status);
                $("#address").val(data.address);
                $("#phonenumber").val(data.phonenumber);
        },
        error: function (error) {
            console.log("error");
        },
    });
});


//instructor UPDATE
$("#instructorUpdate").on("click", function (e) {
    e.preventDefault();
    var id = $("#id").val();
    var data = $("#gform")[0];
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }
    var table = $("#gtable").DataTable();
    console.log(id);

    $.ajax({
        type: "POST",
        url: "/api/instructors/" + id,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            // $("#instructorModal").modal("hide");
            // table.ajax.reload();
            bootbox.alert("Instructor has been updated!", function() {
                $("#instructorModal").modal("hide");
                table.ajax.reload();
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//DELETE
$("#gbody").on("click", ".deletebtn", function (e) {
    var id = $(this).data("id");
    var $tr = $(this).closest("tr");
    // var id = $(e.relatedTarget).attr('id');
    console.log(id);
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this instructor?",
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
                    url: "/api/instructors/" + id,
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