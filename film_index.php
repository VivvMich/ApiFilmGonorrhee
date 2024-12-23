<?php
include "base.php";
if (isset($_SESSION['name'])) {
?>
    <h1 class="red text-center">COUCOU <?= $_SESSION['name'] ?></h1>

<?php } ?>
<script>
    async function fetchMovies(genre = '', certification = '') {
        const apiKey = 'metre la cle api';

        // metre lurl 
        let url = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&language=fr&with_genres=${genre}&certification_country=FR&certification=${certification}`;

        try {
            let response = await fetch(url);
            let data = await response.json();

            // Afficher les films
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

        // Met à jour la classe active
        document.querySelectorAll(`a[data-type="${type}"]`).forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');

        fetchMovies(genre, certification);
    }
</script>
</head>

<body>
    <h1 class="text-center mt-5">Bienvenue sur la page des films</h1>

    <div class="">
        <h3 class="text-center mt-5">Faites Votre Selection</h3>
        <div class="container-fluid d-flex justify-content-center my-4">
            <ul id="with_genres" class="multi_select d-flex  gap-3  list-unstyled">
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="28" onclick="handleFilterClick(event, 'genre', '28')">Action</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="16" onclick="handleFilterClick(event, 'genre', '16')">Animation</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="12" onclick="handleFilterClick(event, 'genre', '12')">Aventure</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="35" onclick="handleFilterClick(event, 'genre', '35')">Comédie</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="14" onclick="handleFilterClick(event, 'genre', '14')">Fantastique</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="27" onclick="handleFilterClick(event, 'genre', '27')">Horreur</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="878" onclick="handleFilterClick(event, 'genre', '878')">Science-Fiction</a></li>
                <li><a class="btn btn-outline-light" href="#" data-type="genre" data-value="53" onclick="handleFilterClick(event, 'genre', '53')">Thriller</a></li>
            </ul>
        </div>
    </div>

    <div>
        <h3 class="text-center mt-5">Certifications</h3>
        <div class="container d-flex justify-content-center  my-4 ">
            <ul id="certification" class="multi_select d-flex gap-3 list-unstyled ">
                <li class="btn btn-outline-success"><a href="#" data-type="certification" data-value="-18" onclick="handleFilterClick(event, 'certification', '-18')">18-</a></li>
                <li class="btn btn-outline-danger"><a href="#" data-type="certification" data-value="18" onclick="handleFilterClick(event, 'certification', '18')">18+</a></li>
            </ul>
        </div>

    </div>

    <div id="movies" class="films">
        <!-- Contenu des films sera affiché ici -->
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
    </div>
</body>

</html>