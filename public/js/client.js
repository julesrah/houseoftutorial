$(document).ready(function () {
    $("#ltable").DataTable({
        ajax: {
           url: "/api/client/all",
         //   url: "http://localhost:8000/api/v1/client",
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
                text: "Add Client",
                className: "btn btn-success",
                action: function (e, dt, node, config) {
                    $("#eform").trigger("reset");
                    $("#clientModal").modal("show");
                },
            },
        ],
        columns: [
            {
                data: "id",
            },
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

    $("#ltable wbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');
        
        $.ajax({
            type: "GET",
            url: "api/client/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                   $("#ititle").val(data.title);
                   $("#ifirstName").val(data.firstName);
                   $("#ilastName").val(data.lastName);
                   $("#iage").val(data.age);
                   $("#iaddress").val(data.address);
                   $("#isex").val(data.sex);
                   $("#iphonenumber").val(data.phonenumber);
                   $("#imagePath").val(data.imagePath);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
    });

    $("#clientModal").on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).attr("data-id");
        // console.log(id);
        $("<input>")
            .attr({ type: "hidden", id: "clientid", name: "id", value: id })
            .appendTo("#eform");
        $.ajax({
            type: "GET",
            url: "/api/client/" + id + "/edit",
            success: function (data) {
                console.log(data);
                   $("#title").val(data.title);
                   $("#firstName").val(data.firstName);
                   $("#lastName").val(data.lastName);
                   $("#age").val(data.age);
                   $("#address").val(data.address);
                   $("#sex").val(data.sex);
                   $("#phonenumber").val(data.phonenumber);
                   $("#imagePath").val(data.imagePath);
            },
            error: function () {
                console.log("AJAX load did not work");
                alert("error");
            },
        });
    });

    $("#clientSubmit").on("click", function (e) {
        var id = $("#clientid").val();
        var data = $("#eform")[0];
        let formData = new FormData($("#eform")[0]);
        $.ajax({
            type: "POST", //PUT
            url: "/api/client/" + id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#clientModal").modal("hide");
                var $ltable = $("#ltable").DataTable();
                $ltable.row.add(data.clients).draw(false); 
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#lbody").on("click", "a.editBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editModal').modal('show');


        $.ajax({
            type: "GET",
            url: "api/client/" + id + "/edit",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function(data){
                   console.log(data);
                   $("#etitle").val(data.title);
                   $("#efirstName").val(data.firstName);
                   $("#elastName").val(data.lastName);
                   $("#eage").val(data.age);
                   $("#eaddress").val(data.address);
                   $("#esex").val(data.sex);
                   $("#ephonenumber").val(data.phonenumber);
                   $("#imagePath").val(data.imagePath);
                },
                error: function(){
                    console.log('AJAX load did not work');
                    alert("error");
                }
            });
        });
    
    $("#clientbtn").on("click", function (e) {
            e.preventDefault();
            // $("#items").hide("slow");
            $("#client").show();
    });

    $.ajax({
        type: "GET",
        url: "/api/client/all",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            $.each(data, function (key, value) {
                // console.log(value);
                id = value.id;
                var tr = $("<tr>");
                tr.append($("<td>").html(value.id));
                tr.append($("<td>").html(value.title));
                tr.append($("<td>").html(value.firstName));
                tr.append($("<td>").html(value.lastName));
                tr.append($("<td>").html(value.age));
                tr.append($("<td>").html(value.address));
                tr.append($("<td>").html(value.sex));
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
                $("#wbody").append(tr);
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
                    id: "clientid",
                    name: "id",
                    value: id,
                })
                .appendTo("#updateclient");
            $.ajax({
                type: "GET",
                url: "/api/client/" + id + "/edit",
                success: function (data) {
                    console.log(data);
                   $("#etitle").val(data.title);
                   $("#efirstName").val(data.firstName);
                   $("#elastName").val(data.lastName);
                   $("#eage").val(data.age);
                   $("#eaddress").val(data.address);
                   $("#esex").val(data.sex);
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
            $("#updateclient").trigger("reset");
            $("#clientid").remove();
    });

    $("#updatebtn").on("click", function (e) {
        var id = $("#clientid").val();
        var data = $("#updateclient").serialize();
        console.log(data);
        $.ajax({
            type: "PUT",
            url: "/api/client/" + id,
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

    $("#lbody").on("click", ".deletebtn", function (e) {
        var id = $(this).data("id");
        var $tr = $(this).closest("tr");
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
                        url: "/api/client/" + id,
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