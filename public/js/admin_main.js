$(document).ready(function(){

    // обработка событий удаления компаний
    $(document).on('click', '#company-delete', function(event) {
        event.preventDefault();
        var url = $(this).find('.form-delete').attr('action');
        var data = $(this).find('.form-delete').serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                    alert("Selected company deleted!");
                    var elements = $(result).find('#main-table').html();
                    $('#main-table').html(elements);
                    var paginator = $(result).find('#paginator-block').html();
                    $('#paginator-block').html(paginator);
            },
            error: function () {
                alert("Selected company has employees!");
            }
        });
    });

    // обработка событий удаления сотрудников
    $(document).on('click', '#employee-delete', function(event) {
        event.preventDefault();
        var url = $(this).find('.form-delete').attr('action');
        var data = $(this).find('.form-delete').serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (result) {
                alert("Selected employee deleted!");
                var elements = $(result).find('#main-table').html();
                $('#main-table').html(elements);
                var paginator = $(result).find('#paginator-block').html();
                $('#paginator-block').html(paginator);
            }
        });
    });
});