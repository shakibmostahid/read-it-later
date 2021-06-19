$(".view-contents").click(function() {
    var pocketId = $(this).data('id');
    if ($(this).hasClass('disabled') || !pocketId) {
        return false;
    }
    $("#contentDiv").html('');
    $("#pocketTitle").text($(this).data('title'));
    $("#errorText").text('');

    $.ajax({
        type: "GET",
        accepts: {
            text: "application/json"
        },
        url: '/api/v1/pockets/' + pocketId + '/contents/',
        success: function(data) {
            generateContentCard(data.data);
            $('#contentModal').modal('show');
        },
        error: function(data) {
            $("#errorText").text(data.responseJSON.errors);
        }
    });
});

function generateContentCard(data) {
    var div = '';
    data.forEach(function(element) {
        div += '<div class="col-sm-6">' +
            '<div class="card">' +
            '<img class="card-img-top content-img" src="/assets/images/default.jpg" alt="Card image cap">' +
            '<div class="card-body">' +
            '<h5 class="card-title">URL: <a href="' + addHttpProtocol(element.url) + '">' + element.url + '</a></h5>' +
            '<table class="fs-14 mb-10">' +
            '<tr>' +
            '<td>' +
            '<p class="card-text">Created At</p>' +
            '</td>' +
            '<td>' +
            ':' +
            '</td>' +
            '<td>' +
            '<p class="card-text pl-10">' + element.created_at + '</p>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>' +
            '<p class="card-text">Last Updated At</p>' +
            '</td>' +
            '<td>' +
            ':' +
            '</td>' +
            '<td>' +
            '<p class="card-text pl-10">' + element.updated_at + '</p>' +
            '</td>' +
            '</tr>' +
            '</table>' +
            '</div>' +
            '</div>' +
            '</div>';
    });
    if (!div) {
        div = '<h3 class="text-center">No contents available for this pocket!</h3>';
    }
    $("#contentDiv").html(div);
}

function addHttpProtocol(url) {
    if (url.indexOf("http://") != 0 && url.indexOf("https://") != 0) {
        url = 'http://' + url;
    }
    return url;
}