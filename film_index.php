<?php
include "base.php";
if (isset($_SESSION['name'])) {
?>
    <h1 class="red text-center">Ravis de vous revoir <?= $_SESSION['name'] ?></h1>
<?php } ?>

<div class="">
    <h3 class="text-center mt-5">Faites Votre Sélection</h3>
    <div class="container-fluid d-flex justify-content-center my-4">
        <ul id="with_genres" class="multi_select d-flex gap-3 list-unstyled">
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="28">Action</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="16">Animation</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="12">Aventure</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="35">Comédie</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="14">Fantastique</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="27">Horreur</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="878">Science-Fiction</a></li>
            <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="53">Thriller</a></li>
            <li>
                <select class="form-select mx-2 btn btn-outline-light" name="sort" id="sort">
                    <option value="popularity.desc">Popularité </option>
                    <option value="original_title.asc">Titre </option>
                    <option value="primary_release_date.desc">Date de sortie </option>
                </select>
            </li>
        </ul>
    </div>
</div>

<div>
    <div class="container d-flex justify-content-center my-4">
        <ul id="certification" class="multi_select d-flex gap-3 list-unstyled">
            <?php if (isset($_SESSION['isAdult']) && $_SESSION['isAdult']) { ?>
                <li><a class="btn btn-outline-danger" href="#" data-type="certification" data-value="18">18+</a></li>
            <?php } ?>
        </ul>
    </div>
</div>


<div id="movies" class="films">
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center gap-3">
            <li class="page-item btn btn-outline-warning"><a id="prev" class="page-link"><i class="bi bi-caret-left"></i></a></li>
            <li class="page-item btn btn-outline-warning"><a id="next" class="page-link"><i class="bi bi-caret-right"></i></a></li>
        </ul>
    </nav>

    <div class="container mt-4" id="listCont">
        <div class="row d-flex flex-wrap" id="movie-list"></div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const genreLinks = document.querySelectorAll('#with_genres a');
        const certificationLinks = document.querySelectorAll('#certification a');
        const searchBar = document.querySelector('#search');
        const resultsContainer = document.querySelector('#results');
        const listCont = document.getElementById('movie-list');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        let currentPage = 1;
        let currentGenre = '';
        let currentCertification = '';
        let includeAdult = false;
        const apiKey = '1ad85edbaf3c9e3de31ca2ecc58fcee9';

        async function fetchMovies(page = 1, genre = '', certification = '', adult = false, query = '') {
            const sort = document.getElementById('sort');
            let url = `https://api.themoviedb.org/3/discover/movie?include_adult=${adult}&sort_by=${sort.value}&include_video=false&language=fr-FR&page=${page}&with_genres=${genre}&certification_country=FR&certification=${certification}&api_key=${apiKey}`;

            if (query) {
                url = `https://api.themoviedb.org/3/search/movie?query=${encodeURIComponent(query)}&include_adult=${adult}&language=fr-FR&page=${page}&api_key=${apiKey}`;
            }

            try {
                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error(`Erreur API : ${response.statusText} (Code ${response.status})`);
                }

                const data = await response.json();
                listCont.innerHTML = '';
                resultsContainer.innerHTML = '';

                if (data.results && data.results.length > 0) {
                    data.results.forEach(movie => {
                        const imageURL = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'image/static/placeholder.png';
                        const card = document.createElement('div');
                        card.classList.add('col-12', 'col-md-6', 'col-lg-4', 'mb-4');
                        card.innerHTML = `
                   <div class="card mx-auto border border-warning border-2 rounded-4 overflow-hidden" style="width: 18rem;">
                            
                            <img class="card-img-top rounded-3" src= ${imageURL} alt="${movie.title}">
                            <div class="card-body">
                                <h5 class="card-title">${movie.title}</h5>
                                <p class="card-text overflow-y-auto">${movie.overview}</p>
                                <a href="film_info.php?id=${movie.id}" class="btn btn-outline-primary" target="_blank">Plus d'infos</a>
                            </div>
                        </div>`;
                        listCont.appendChild(card);
                    });

                    prevButton.disabled = page === 1;
                    nextButton.disabled = page === data.total_pages;
                } else {
                    listCont.innerHTML = '<p class="text-center">Aucun film trouvé pour cette recherche.</p>';
                }
            } catch (err) {
                console.error('Erreur lors de la récupération des films :', err);
                listCont.innerHTML = '<p class="text-center text-danger">Une erreur est survenue. Veuillez réessayer plus tard.</p>';
            }
        }

        function handleFilterClick(type, value) {
            if (type === 'genre') {
                currentGenre = value;
                genreLinks.forEach(link => link.classList.remove('active'));
            } else if (type === 'certification') {
                currentCertification = value;
                certificationLinks.forEach(link => link.classList.remove('active'));

                includeAdult = value === '18';
            }

            document
                .querySelector(`a[data-type="${type}"][data-value="${value}"]`)
                ?.classList.add('active');

            fetchMovies(currentPage, currentGenre, currentCertification, includeAdult);
        }

        genreLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                handleFilterClick('genre', link.getAttribute('data-value'));
            });
        });

        certificationLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                handleFilterClick('certification', link.getAttribute('data-value'));
            });
        });

        searchBar.addEventListener('input', (event) => {
            const query = event.target.value.trim();
            if (query) {
                fetchMovies(1, '', '', includeAdult, query);
            } else {
                resultsContainer.innerHTML = '';
            }
        });

        searchBar.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                const query = searchBar.value.trim();
                if (query) {
                    fetchMovies(1, '', '', includeAdult, query);
                }
            }
        });

        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                fetchMovies(currentPage, currentGenre, currentCertification, includeAdult);
            }
        });

        nextButton.addEventListener('click', () => {
            currentPage++;
            fetchMovies(currentPage, currentGenre, currentCertification, includeAdult);
        });
        sort.addEventListener('change', () => {
            fetchMovies(currentPage, currentGenre, currentCertification, includeAdult);
        });



        fetchMovies(currentPage);
    });
</script>

</body>

</html>