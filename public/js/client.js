$(document).ready(function () {
    $("#ftable").DataTable({
        ajax: {
            url: "/api/clients/all",
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
                text: "Add Client",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#fform").trigger("reset");
                    $("#clientModal").modal("show");
                },
            },
        
        ],
        columns: [
            {
                data: "id",
            },
            // {
            //     data: "user_id",
            // },
            {
                data: "title",
            },

            {
                data: "firstName",
            },
            {
                data: "lastName",
            },
            {
                data: "age",
            },
            {
                data: "address",
            },
            {
                data: "sex",
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

$("#clientSubmit").on("click", function (e) {
        
    e.preventDefault();
    var data = $("#fform")[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }

    $.ajax({
        type: "POST",
        url: "/api/clients/store",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var $ftable = $("#ftable").DataTable();
            $ftable.row.add(data.client).draw(false);

            bootbox.alert("Client created!", function() {
                location.reload(true);
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//EDIT
$("#ftable tbody").on("click", "a.editBtn", function (e) {
    e.preventDefault();
    $("#clientModal").modal("show");
    var id = $(this).data("id");

    $.ajax({
        type: "GET",
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        url: "/api/clients/" + id + "/edit",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
                $("#id").val(data.id);
                // $("#user_id").val(data.user_id);
                $("#title").val(data.title);
                $("#firstName").val(data.firstName);
                $("#lastName").val(data.lastName);
                $("#age").val(data.age);
                $("#address").val(data.address);
                $("#sex").val(data.sex);
                $("#phonenumber").val(data.phonenumber);
        },
        error: function (error) {
            console.log("error");
        },
    });
});


//client UPDATE
$("#clientUpdate").on("click", function (e) {
    e.preventDefault();
    var id = $("#id").val();
    var data = $("#fform")[0];
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + "," + pair[1]);
    }
    var table = $("#ftable").DataTable();
    console.log(id);

    $.ajax({
        type: "POST",
        url: "/api/clients/" + id,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            // $("#clientModal").modal("hide");
            // table.ajax.reload();
            bootbox.alert("client has been updated!", function() {
                $("#clientModal").modal("hide");
                table.ajax.reload();
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
});


//DELETE
$("#fbody").on("click", ".deletebtn", function (e) {
    var id = $(this).data("id");
    var $tr = $(this).closest("tr");
    // var id = $(e.relatedTarget).attr('id');
    console.log(id);
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this client?",
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
                    url: "/api/clients/" + id,
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