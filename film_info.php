<?php
include "base.php";
include "pdo.php";
?>

    
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 60rem;" id="movie-card">
        <div class="row">
            <div class=" col-md-6 col-12"> 
                <img id="movie-img" style="height: 40rem;" src="..." class=" card-img-top" alt="Movie Poster">
            </div>
            <div class="col-md-6 col-12">
            <div class="card-body">
            <h5 class="card-title" id="movie-title"></h5>
            <p class="card-text overflow-y-auto" id="movie-desc"></p>
        </div>
        <ul class="list-group list-group-flush" id="movie-details">
            <li class="list-group-item" id="movie-date-de-sortie"></li>
            <li class="list-group-item" id="movie-vo"></li>
            <li class="list-group-item" id="movie-note"></li>
            <li class="list-group-item" id="movie-durée"></li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link" id="movie-link">Plus d'info</a>
        </div>
        <div id="movie-trailer"> 
                </div> 
            </div>
        </div>
    </div>
</div>

<script>
const movieCard = document.getElementById('movie-card');


const urlParams = new URLSearchParams(window.location.search);
const movieId = urlParams.get("id");
console.log(movieId);

const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0MjIxN2M5ODIxMTg0YjUxYTdmMDUxYThkNDJhYjVkNSIsIm5iZiI6MTczNDUzNDUyNS4wODA5OTk5LCJzdWIiOiI2NzYyZTU3ZDE2MWFiN2RlYzVmZmU5M2EiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.nelI2eP8ADX9lQ9-M3EeozH96l4nXeoLeonyPf3G8FA'
  }
};

fetch(`https://api.themoviedb.org/3/movie/${movieId}?language=fr-FR`, options)
  .then(res => res.json())
  .then(movie => {
    const langDisplayNames = new Intl.DisplayNames(['fr'], { type: 'language' }); 
    let fullLangName = langDisplayNames.of(movie.original_language);
    fullLangName = fullLangName.charAt(0).toUpperCase() + fullLangName.slice(1)
    document.getElementById('movie-img').src = `https://image.tmdb.org/t/p/original${movie.poster_path}`;
    document.getElementById('movie-img').alt = movie.title;
    document.getElementById('movie-title').innerText = movie.title;
    document.getElementById('movie-desc').innerText = movie.overview;
    document.getElementById('movie-date-de-sortie').innerText = `Date de sortie: ${movie.release_date}`;
    document.getElementById('movie-vo').innerHTML = `Langue original: ${fullLangName}`
    document.getElementById('movie-note').innerText = `Note: ${movie.vote_average}`;
    document.getElementById('movie-durée').innerText = `Durée: ${movie.runtime} minutes`;
    document.getElementById('movie-link').href = `https://www.themoviedb.org/movie/${movie.id}`;
  })
  .catch(err => console.error(err));


fetch(`https://api.themoviedb.org/3/movie/${movieId}/videos?language=fr-FR`, options) 
.then(res => res.json()) 
.then(data => { 
    const trailer = data.results.find(video => video.type === 'Trailer' && video.site === 'YouTube');
     if (trailer) { 
        const trailerDiv = document.getElementById('movie-trailer'); 
        const iframe = document.createElement('iframe');
        iframe.width = "100%"; iframe.height = "315";
        iframe.src = `https://www.youtube.com/embed/${trailer.key}`;
        iframe.frameBorder = "0"; 
        iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"; 
        iframe.allowFullscreen = true; 
        trailerDiv.appendChild(iframe); 
    } 
}) .catch(err => console.error(err));


</script>

</body>
</html>
