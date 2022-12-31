$(document).ready(function () {

    $("#itable").DataTable({
        ajax: {
           url: "/api/instrument/all",
         //   url: "http://localhost:8000/api/v1/instrument",
            dataSrc: "",
        },
        dom: 'Bfrtip',
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
                    $("#iform").trigger("reset");
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
                 render: function (data,type,JsonResultRow,row) {
                     return '<img src="/storage/' + JsonResultRow.imagePath + '" width="100px" height="100px">';
                 }, 
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' data-bs-toggle='modal' class='editBtn' data-bs-target='#editInstrumentModal' id='editbtn' data-id=" +
                        data.id +"><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' id='deletebtn' data-id=" + data.id + "><i class='fa-regular fa-trash-can' style='font-size:24px; color:red'></a></i>";
                },
            },
        ],
    });

    $("#itable ibody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editInstrumentModal').modal('show');


        $.ajax({
            type: "GET",
            url: "api/instrument/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                   $("#iname").val(data.name);
                   $("#itype").val(data.type);
                   $("#idescription").val(data.description);
                   $("#icondition").val(data.condition);
                   $("#imagePath").val(data.imagePath);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
        });

    $("#instrumentSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#iform")[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + "," + pair[1]);
        }

        $.ajax({
            type: "POST",
            url: "/api/instrument/store",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#instrumentModal").modal("hide");
                var $itable = $("#itable").DataTable();
                $itable.row.add(data.instruments).draw(false);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#ibody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editInstrumentModal').modal('show');


        $.ajax({
            type: "GET",
            url: "api/instrument/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                   $("#iname").val(data.name);
                   $("#itype").val(data.type);
                   $("#idescription").val(data.description);
                   $("#icondition").val(data.condition);
                   $("#imagePath").val(data.imagePath);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
        });

    $("#instrumentbtn").on("click", function (e) {
        e.preventDefault();
        // $("#items").hide("slow");
        $("#intruments").show();
    });

    $.ajax({
        type: "GET",
        url: "/api/instrument/all",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            $.each(data, function (key, value) {
                // console.log(value);
                id = value.id;
                var tr = $("<tr>");
                tr.append($("<td>").html(value.id));
                tr.append($("<td>").html(value.name));
                tr.append($("<td>").html(value.type));
                tr.append($("<td>").html(value.description));
                tr.append($("<td>").html(value.condition));
                tr.append($("<td>").html(value.imagePath));
                // tr.append(
                //     "<td align='center'><a href=" +
                //         "/api/customer/" +
                //         id +
                //         "/edit" +
                //         "><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></a></i></td>"
                // );
                tr.append(
                    "<td align='center'><a href='#' data-bs-toggle='modal' data-bs-target='#editModal' id='editbtn' data-id=" +
                        id +
                        "><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></a></i></td>"
                );
                tr.append(
                    "<td><a href='#'  class='deletebtn' data-id=" +
                        id +
                        "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i></td>"
                );
                $("#cbody").append(tr);
            });
        },
        error: function () {
            console.log("AJAX load did not work");
            alert("error");
        },
    });

    $("#myFormSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $("#cform").serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/api/instrument",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                // $("myModal").modal("hide");
                $("#myModal").each(function () {
                    $(this).modal("hide");
                });
                var tr = $("<tr>");
                tr.append($("<td>").html(data.id));
                tr.append($("<td>").html(value.name));
                tr.append($("<td>").html(value.type));
                tr.append($("<td>").html(value.description));
                tr.append($("<td>").html(value.condition));
                tr.append($("<td>").html(value.imagePath));
                tr.append(
                    "<td align='center'><a href='#' data-bs-toggle='modal' data-bs-target='#editModal' id='editbtn' data-id=" +
                        id +
                        "><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size:24px' ></a></i></td>"
                );
                tr.append(
                    "<td><a href='#'  class='deletebtn' data-id=" +
                        id +
                        "><i  class='fa fa-trash-o' style='font-size:24px; color:red' ></a></i></td>"
                );
                $("#cbody").prepend(tr);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#cbody").on("click", ".deletebtn", function (e) {
        var id = $(this).data("id");
        var $tr = $(this).closest("tr");
        // var id = $(e.relatedTarget).attr('id');
        console.log(id);
        e.preventDefault();
        bootbox.confirm({
            message: "Do you want to delete this instrument?",
            buttons: {
                confirm: {
                    label: "yes",
                    className: "btn-success",
                },
                cancel: {
                    label: "no",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                if (result)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/intrument/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            // bootbox.alert('success');
                            $tr.find("td").fadeOut(2000, function () {
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

    $("#editModal").on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).attr("data-id");
        console.log(id);
        $("<input>")
            .attr({
                type: "hidden",
                id: "instrumentid",
                name: "id",
                value: id,
            })
            .appendTo("#updateform");
        $.ajax({
            type: "GET",
            url: "/api/instrument/" + id + "/edit",
            success: function (data) {
                console.log(data);
                $("#ename").val(data.name);
                $("#etype").val(data.type);
                $("#edescription").val(data.description);
                $("#econdition").val(data.condition);
                $("#imagePath").val(data.imagePath);
            },
            error: function () {
                console.log("AJAX load did not work");
                alert("error");
            },
        });
    });

    $("#editModal").on("hidden.bs.modal", function (e) {
        $("#updateform").trigger("reset");
        $("#instrumentid").remove();
    });

    $("#updatebtn").on("click", function (e) {
        var id = $("#instrumentid").val();
        var data = $("#updateform").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/instrument/" + id,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#editModal").each(function () {
                    $(this).modal("hide");
                    window.location.reload();
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});