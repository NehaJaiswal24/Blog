<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="create_card_style.css">
</head>
<body>
    <div class="container">
        <div id="dataContainer" class="row"></div>
        <div id="paginationContainer" class="mt-3"></div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    function showData(page = 1) {
        const searchTerm = new URLSearchParams(window.location.search).get('search-box') || '';

        $.ajax({
            url: "fetch_card.php",
            method: "GET",
            data: { page: page, 'search-box': searchTerm },
            dataType: 'json',
            success: function(response) {
                $('#dataContainer').empty();

                if (response.data && response.data.length > 0) {
                    var contentLimit = 100;

                    response.data.forEach(function(row) {
                        var post_id = row.post_id;
                        var originalContent = row.content;
                        var truncatedContent = originalContent.length > contentLimit
                            ? originalContent.substring(0, contentLimit) + '... <a href="view-more.php?post_id=' + post_id + '">Read more</a>'
                            : originalContent + ' <a href="view-more.php?post_id=' + post_id + '">Read more</a>';

                        $('#dataContainer').append(`
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">${row.title}</h5>
                                        <p class="card-text">${truncatedContent}</p>
                                        <p class="card-text"><small class="text-body-secondary">${row.date}</small></p>
                                        <p class="card-text">${row.fname} ${row.lname}</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                    $('#paginationContainer').html(response.pagination);
                } else {
                    $('#dataContainer').html('<div class="col-12">No records found</div>');
                }
            },
            error: function(error) {
                console.error("Error fetching data:", error);
                $('#dataContainer').html('<div class="col-12">Error loading data</div>');
            }
        });
    }

    showData();

    $(document).on('click', '#paginationContainer a', function(event) {
        event.preventDefault();
        const pageId = $(this).data('page');
        showData(pageId);
    });
});
</script>
