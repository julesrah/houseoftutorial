var serviceCount = 0;
var priceTotal = 0.00;
var session = 0;
var clone = "";

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/services/all",
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                // console.log(key);
                id = value.id;
                var service = "<div class='service'><br><div class='serviceDetails'><div class='serviceImage'><img src=" + "/storage/" + value.service_img +
                    " width='200px', height='200px'/></div><div class='serviceText'><p class='price-container'><strong><h6><span class='title'>" + value.servname + "</h6></strong>" + "Price: Php <span class='price'>" + value.price +
                    "</span></p><p>" + value.description + "</p></div><input type='number' class='session' name='session'><p class='serviceId' hidden style='float:right'>" + value.id +
                    "</p></div><button type='button' class='btn btn-primary add' style='margin-top:5px;'>Add to cart</button></div>";
                $("#services").append(service);
            });
        },
        error: function () {
            console.log('AJAX load did not work');
            alert("error");
        }
    });


    $("#services").on('click', '.add', function () {
        serviceCount++;
        // serviceCount=3;
        $('#serviceCount').text(serviceCount).css('display', 'block');
        clone = $(this).siblings().clone().appendTo('#cartServices')
            .append('<button class="removeService">Remove Service</button>');
        var price = parseInt($(this).siblings().find('.price').text());
        priceTotal += price;
        $('#cartTotal').text("Total: ₱" + priceTotal);
    });


    $('.openCloseCart').click(function () {
        $('#shoppingCart').toggle();
    });

    $('#shoppingCart').on('click', '.removeService', function () {
        $(this).parent().remove();
        serviceCount--;
        $('#serviceCount').text(serviceCount);

        // Remove Cost of Deleted Service from Total Price
        var price = parseInt($(this).siblings().find('.price').text());
        priceTotal -= price;
        $('#cartTotal').text("Total: php" + priceTotal);

        if (serviceCount == 0) {
            $('#serviceCount').css('display', 'none');
        }
    });

    $('#emptyCart').click(function () {
        serviceCount = 0;
        priceTotal = 0;

        $('#serviceCount').css('display', 'none');
        $('#cartServices').text('');
        $('#cartTotal').text("Total: $" + priceTotal);
    });

    $('#checkout').click(function () {
        serviceCount = 0;
        priceTotal = 0;
        let services = new Array();

        $("#cartServices").find(".serviceDetails").each(function (i, element) {
            // console.log(element);
            let serviceid = 0;
            let session = 0;

            session = parseInt($(element).find($(".session")).val());
            serviceid = parseInt($(element).find($(".serviceId")).html());

            services.push({
                "id": serviceid,
                "session": session
            });

        });
        console.log(JSON.stringify(services));
        var data = JSON.stringify(services);

        $.ajax({
            type: "POST",
            url: "/api/service/checkout",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            processData: false,
            contentType: 'application/json; charset=utf-8',
            success: function (data) {
                console.log(data);

                bootbox.alert("You have made an appointment!", function() {
                    location.reload(true);
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
        $('#serviceCount').css('display', 'none');
        $('#cartservices').text('');
        $('#cartTotal').text("Total: ₱" + priceTotal);
        $('#shoppingCart').css('display', 'none');
    });
})