
function searchMovie() {

$('movie-list').html('')
$.ajax({
    url: 'http://omdbapi.com',
    type: 'get',
    dataType: 'json',
    data: {
        'apikey': '36115aa7',
        's' : $('#search-input').val()
    },
    // kalo sukses
    success: function(result) {
       if (result.Response == "True") {
        let movies = result.Search
    

$.each(movies, function(i, data) {
$('#movie-list').append(`<div class="col-md-4">
    <div class="card mb-7">
<img src="`+ data.Poster +`">
<div class="card-body">
<h5 class="card-title">`+ data.Title +`</h5>
<p class="card-subtitle">`+ data.Year +`</p>
<a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" data-id="`+ data.imdbID +`">See details</a>
</div>
</div>
    </div>`)
})

$('#search-input').val('')

}  else {
        $('#movie-list').html(`
            <div class="col" >
            <h1 class="text-center">` + result.Error + `</h1>
            </div>
            `)
       }
    }
}
)
}




$('#search-button').on('click', function() {
    searchMovie()
})

$('#search-input').on('keyup', function(e) {
    if(e.which === 13) {
        searchMovie()
    }
})

// jquery carikan saya element movie-list lalu ketika saya klik sebuah element yang kelas nya see-detail yang di dalamnya baik muncul nya dari awal maupun nanti ketika saya jalankan pakai ajax nya, jalan kan function ini

$('#movie-list').on('click', '.see-detail', function() {
    $.ajax({
        url: 'https://omdbapi.com',
        type: 'get',
        dataType: 'JSON',
        data: {
            'apikey': '36115aa7',
            'i': $(this).data('id')
        },
        success: function(movie) {
            if (movie.Response == "True") {
                $('.modal-body').html(`
            <div class="container-fluid">
                <div class="row">
                    <div class="row-md-4">
                    <img src="`+ movie.Poster +` class="img-fluit"">
                    </div>

            <div class="row-md-8">
                <ul class="list-group">
                    <li class="list-group-item"><h3>`+ movie.Title +`</h3></li>
                    <li class="list-group-item">Relased: `+ movie.Released +`</li>
                    <li class="list-group-item">Genre: `+ movie.Genre +`</li>
                    <li class="list-group-item">Actors: `+ movie.Actors +`</li>
                </ul>
                </div>
            </div>
                    `)
            }
        }
    })
})