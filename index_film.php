<?php
include "base.php";
include "pdo.php";
?>

<nav aria-label="Pagination">
  <ul class="pagination justify-content-center">
    <li class="page-item"><a id="prev" class="page-link"><< Précédent</a></li>
    <li class="page-item"><a id="next" class="page-link">Suivant >></a></li>
  </ul>
</nav>

<div class="container mt-4" id="listCont">
    <div class="row d-flex flex-wrap" id="movie-list">
        
    </div>
</div>

<script>
const listCont = document.getElementById('movie-list');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
let currentPage = 1;

const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0MjIxN2M5ODIxMTg0YjUxYTdmMDUxYThkNDJhYjVkNSIsIm5iZiI6MTczNDUzNDUyNS4wODA5OTk5LCJzdWIiOiI2NzYyZTU3ZDE2MWFiN2RlYzVmZmU5M2EiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.nelI2eP8ADX9lQ9-M3EeozH96l4nXeoLeonyPf3G8FA'
  }
};

function fetchMovies(page) {
    fetch(`https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=fr-FR&page=${page}&sort_by=popularity`, options)
        .then(res => res.json())
        .then(res => {
            listCont.innerHTML = ''; 
            const movies = res.results;
            movies.forEach(movie => {
                const card = document.createElement('div');
                card.classList.add('col-12', 'col-md-6', 'col-lg-4', 'mb-4');
                card.innerHTML = `
                    <div class="card mx-auto" style="width: 18rem;">
                        <img class="card-img-top" src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title}">
                        <div class="card-body">
                            <h5 class="card-title">${movie.title}</h5>
                            <p class="card-text overflow-y-auto ">${movie.overview}</p>
                            <a href="film_info.php?id=${movie.id}" class="btn btn-primary" target="_blank">Plus d'infos</a>
                        </div>
                    </div>
                `;
                listCont.appendChild(card);
            });
        
            prevButton.disabled = page === 1;
            nextButton.disabled = page === res.total_pages;
        })
        .catch(err => console.error(err));
}

fetchMovies(currentPage);

prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        fetchMovies(currentPage);
    }
});

nextButton.addEventListener('click', () => {
    currentPage++;
    fetchMovies(currentPage);
});
</script>

</body>
</html>
