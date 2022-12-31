$(document).ready(function () {
    $("#ptable").DataTable({
        ajax: {
           url: "/api/instructor/all",
         //   url: "http://localhost:8000/api/v1/instructor",
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
                text: "Add Instructor",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#pform").trigger("reset");
                    $("#instructorModal").modal("show");
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
                data: "specialty",
            },
            {
                data: "description",
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
                 render: function (data,type,JsonResultRow,row) {
                     return '<img src="storage/' + JsonResultRow.imagePath + '" width="125px" height="125px">';
                 }, 
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' data-bs-toggle='modal' class='editBtn' data-bs-target='#editModal' id='editbtn' data-id=" +
                        data.id +"><i class='fa-solid fa-pen-to-square' aria-hidden='true' style='font-size:24px' ></i></a>   <a href='#' class='deletebtn' id='deletebtn' data-id=" + data.id + "><i class='fa-regular fa-trash-can' style='font-size:24px; color:red'></a></i>";
                },
            },
        ],
    });

    $("#ptable tbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');
        
        $.ajax({
            type: "GET",
            url: "api/instructor/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                //    $("#iuser_id").val(data.user_id);
                   $("#iname").val(data.name);
                   $("#ispecialty").val(data.specialty);
                   $("#idescription").val(data.description);
                   $("#istatus").val(data.status);
                   $("#iaddress").val(data.address);
                   $("#iphonenumber").val(data.phonenumber);
                   $("#imagePath").val(data.imagePath);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
    });

    $("#instructorModal").on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).attr("data-id");
        // console.log(id);
        $("<input>")
            .attr({ type: "hidden", id: "instructorid", name: "id", value: id })
            .appendTo("#pform");
        $.ajax({
            type: "GET",
            url: "/api/instructor/" + id + "/edit",
            success: function (data) {
                console.log(data);
                $("#name").val(data.name);
                $("#specialty").val(data.specialty);
                $("#description").val(data.description);
                $("#status").val(data.status);
                $("#address").val(data.address);
                $("#phonenumber").val(data.phonenumber);
                $("#uploads").val(data.imagePath);
            },
            error: function () {
                console.log("AJAX load did not work");
                alert("error");
            },
        });
    });

    $("#instructorSubmit").on("click", function (e) {
        var id = $("#instructorid").val();
        var data = $("#pform")[0];
        let formData = new FormData($("#pform")[0]);
        $.ajax({
            type: "POST", //PUT
            url: "/api/instructor/" + id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#instructorModal").modal("hide");
                var $ptable = $("#ptable").DataTable();
                $ptable.row.add(data.instructors).draw(false); 
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#pbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');


        $.ajax({
            type: "GET",
            url: "api/instructor/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                    $("#ename").val(data.name);
                    $("#especialty").val(data.specialty);
                    $("#edescription").val(data.description);
                    $("#estatus").val(data.status);
                    $("#eaddress").val(data.address);
                    $("#ephonenumber").val(data.phonenumber);
                   $("#imagePath").val(data.imagePath);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
        });
    
    $("#instructorbtn").on("click", function (e) {
            e.preventDefault();
            // $("#items").hide("slow");
            $("#instructor").show();
    });

    $.ajax({
        type: "GET",
        url: "/api/instructor/all",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            $.each(data, function (key, value) {
                // console.log(value);
                id = value.id;
                var tr = $("<tr>");
                tr.append($("<td>").html(value.id));
                tr.append($("<td>").html(value.name));
                tr.append($("<td>").html(value.specialty));
                tr.append($("<td>").html(value.description));
                tr.append($("<td>").html(value.status));
                tr.append($("<td>").html(value.address));
                tr.append($("<td>").html(value.phonenumber));
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
                $("#tbody").append(tr);
            });
        },
        error: function () {
            console.log("AJAX load did not work");
            alert("error");
        },
    });
    
     $("#editModal").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).attr("data-id");
            console.log(id);
            $("<input>")
                .attr({
                    type: "hidden",
                    id: "instructorid",
                    name: "id",
                    value: id,
                })
                .appendTo("#updateinstructor");
            $.ajax({
                type: "GET",
                url: "/api/instructor/" + id + "/edit",
                success: function (data) {
                    console.log(data);
                    $("#ename").val(data.name);
                    $("#especialty").val(data.specialty);
                    $("#edescription").val(data.description);
                    $("#estatus").val(data.status);
                    $("#eaddress").val(data.address);
                    $("#ephonenumber").val(data.phonenumber);
                    $("#imagePath").val(data.imagePath);
                },
                error: function () {
                    console.log("AJAX load did not work");
                    alert("error");
                },
            });
    });
    
    $("#editModal").on("hidden.bs.modal", function (e) {
            $("#updateinstructor").trigger("reset");
            $("#instructorid").remove();
    });

    $("#updatebtn").on("click", function (e) {
        var id = $("#instructorid").val();
        var data = $("#updateinstructor").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/instructor/" + id,
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

    $("#pbody").on("click", ".deletebtn", function (e) {
        var id = $(this).data("id");
        var $tr = $(this).closest("tr");
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
                        url: "/api/instructor/" + id,
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