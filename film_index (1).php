<?php
include "base.php";
if (isset($_SESSION['name'])) {
?>
    <h1 class="red text-center">Ravis de vous revoir <?= $_SESSION['name'] ?></h1>

<?php } ?>
<script>
    async function fetchMovies(genre = '', certification = '') {
        const apiKey = 'metre la cle api';


        let url = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=fr&with_genres=${genre}&certification_country=FR&certification=${certification}`;

        try {
            let response = await fetch(url);
            let data = await response.json();


            const movieContainer = document.getElementById('movies');
            movieContainer.innerHTML = '';

            data.results.forEach(movie => {
                const movieElement = document.createElement('div');
                movieElement.innerHTML = `<strong>${movie.title}</strong> (${movie.release_date})<br>${movie.overview}`;
                movieContainer.appendChild(movieElement);
            });
        } catch (error) {
            console.error('Erreur:', error);
        }
    }

    function handleFilterClick(event, type, value) {
        event.preventDefault();
        const genre = type === 'genre' ? value : document.querySelector('a[data-type="genre"].active')?.dataset.value || '';
        const certification = type === 'certification' ? value : document.querySelector('a[data-type="certification"].active')?.dataset.value || '';


        document.querySelectorAll(`a[data-type="${type}"]`).forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');

        fetchMovies(genre, certification);
    }
</script>
</head>

<body>




    <div class="">
        <h3 class="text-center mt-5">Faites Votre Selection</h3>
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
            </ul>
        </div>
    </div>

    <div>
        <h3 class="text-center mt-5">Certifications</h3>
        <div class="container d-flex justify-content-center my-4">
            <ul id="certification" class="multi_select d-flex gap-3 list-unstyled">
                <li class="btn btn-outline-success"><a href="#" data-type="certification" data-value="-18">18-</a></li>
                <li class="btn btn-outline-danger"><a href="#" data-type="certification" data-value="18">18+</a></li>
            </ul>
        </div>
    </div>

    </div>

    <div id="movies" class="films">

        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a id="prev" class="page-link">
                        << Précédent</a>
                </li>
                <li class="page-item"><a id="next" class="page-link">Suivant >></a></li>
            </ul>
        </nav>

        <div class="container mt-4" id="listCont">
            <div class="row d-flex flex-wrap" id="movie-list">

            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const genreLinks = document.querySelectorAll('#with_genres a');
                const certificationLinks = document.querySelectorAll('#certification a');
                const listCont = document.getElementById('movie-list');
                const prevButton = document.getElementById('prev');
                const nextButton = document.getElementById('next');
                let currentPage = 1;
                let currentGenre = '';
                let currentCertification = '';


                const genresMap = {
                    "28": "Action",
                    "16": "Animation",
                    "12": "Aventure",
                    "35": "Comédie",
                    "14": "Fantastique",
                    "27": "Horreur",
                    "878": "Science-Fiction",
                    "53": "Thriller"
                };

                const options = {
                    method: 'GET',
                    headers: {
                        accept: 'application/json',
                        Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0MjIxN2M5ODIxMTg0YjUxYTdmMDUxYThkNDJhYjVkNSIsIm5iZiI6MTczNDUzNDUyNS4wODA5OTk5LCJzdWIiOiI2NzYyZTU3ZDE2MWFiN2RlYzVmZmU5M2EiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.nelI2eP8ADX9lQ9-M3EeozH96l4nXeoLeonyPf3G8FA'
                    }
                };


                async function fetchMovies(page = 1, genre = '', certification = '') {
                    const url = `https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=fr-FR&page=${page}&sort_by=popularity&with_genres=${genre}&certification_country=FR&certification=${certification}`;
                    try {
                        const response = await fetch(url, options);
                        const data = await response.json();


                        const moviesByGenre = {};
                        Object.keys(genresMap).forEach(genreId => {
                            moviesByGenre[genreId] = [];
                        });

                        data.results.forEach(movie => {
                            movie.genre_ids.forEach(genreId => {
                                if (moviesByGenre[genreId]) {
                                    moviesByGenre[genreId].push(movie);
                                }
                            });
                        });


                        listCont.innerHTML = '';
                        Object.keys(moviesByGenre).forEach(genreId => {
                            if (moviesByGenre[genreId].length > 0) {
                                const genreSection = document.createElement('div');
                                genreSection.classList.add('genre-section');
                                genreSection.innerHTML = `<h3 class="text-center mt-4">${genresMap[genreId]}</h3>`;

                                const movieRow = document.createElement('div');
                                movieRow.classList.add('row');
                                moviesByGenre[genreId].forEach(movie => {
                                    const card = document.createElement('div');
                                    card.classList.add('col-12', 'col-md-6', 'col-lg-4', 'mb-4');
                                    card.innerHTML = `
                            <div class="card mx-auto" style="width: 18rem;">
                                <img class="card-img-top" src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title}">
                                <div class="card-body">
                                    <h5 class="card-title">${movie.title}</h5>
                                    <p class="card-text overflow-y-auto">${movie.overview}</p>
                                    <a href="film_info.php?id=${movie.id}" class="btn btn-primary" target="_blank">Plus d'infos</a>
                                </div>
                            </div>
                        `;
                                    movieRow.appendChild(card);
                                });

                                genreSection.appendChild(movieRow);
                                listCont.appendChild(genreSection);
                            }
                        });

                        prevButton.disabled = page === 1;
                        nextButton.disabled = page === data.total_pages;
                    } catch (err) {
                        console.error('Erreur lors de la récupération des films :', err);
                    }
                }


                function handleFilterClick(type, value) {
                    if (type === 'genre') {
                        currentGenre = value;
                        genreLinks.forEach(link => link.classList.remove('active'));
                    } else if (type === 'certification') {
                        currentCertification = value;
                        certificationLinks.forEach(link => link.classList.remove('active'));
                    }

                    document
                        .querySelector(`a[data-type="${type}"][data-value="${value}"]`)
                        ?.classList.add('active');

                    fetchMovies(currentPage, currentGenre, currentCertification);
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


                prevButton.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        fetchMovies(currentPage, currentGenre, currentCertification);
                    }
                });

                nextButton.addEventListener('click', () => {
                    currentPage++;
                    fetchMovies(currentPage, currentGenre, currentCertification);
                });


                fetchMovies(currentPage);
            });
        </script>
    </div>
</body>

</html>