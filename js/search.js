function searchProfiles() {
    $('#search-bar').on('keyup', function(){
        var query = $(this).val();
        if (query != '') {
            $.ajax({
                url: "template/search.php",
                method: "POST",
                data: {query:query},
                success: function(data) {
                    $('.search-container').html(data);
                }
            });
        } else {
            $('.search-container').html('');
        }
    });
}

$(document).ready(searchProfiles);