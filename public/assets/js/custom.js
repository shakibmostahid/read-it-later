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
        var imageUrl = element.image_url ? element.image_url : '/assets/images/default.jpg';
        var excerpt = element.excerpt ? '<p class="content-excerpt">' + element.excerpt + '</p>' : '';
        div += '<div class="col-sm-6">' +
            '<div class="card mb-10">' +
            '<img class="card-img-top content-img" src="' + imageUrl + '" alt="Card image cap">' +
            '<div class="card-body">' +
            '<h5 class="card-title"><a href="' + element.url + '">' + (element.title ? element.title : element.url) + '</a></h5>' +
            excerpt +
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