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

    <div>
        <h3 class="text-center mt-5">Genres</h3>
        <div class="container-fluid d-flex justify-content-center my-5">
            <ul id="with_genres" class="multi_select d-flex flex-row gap-3">
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="28" onclick="handleFilterClick(event, 'genre', '28')">Action</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="16" onclick="handleFilterClick(event, 'genre', '16')">Animation</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="12" onclick="handleFilterClick(event, 'genre', '12')">Aventure</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="35" onclick="handleFilterClick(event, 'genre', '35')">Comédie</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="14" onclick="handleFilterClick(event, 'genre', '14')">Fantastique</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="27" onclick="handleFilterClick(event, 'genre', '27')">Horreur</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="878" onclick="handleFilterClick(event, 'genre', '878')">Science-Fiction</a></li>
                <li class="list-unstyled"><a class="btn btn-outline-light" href="#" data-type="genre" data-value="53" onclick="handleFilterClick(event, 'genre', '53')">Thriller</a></li>
            </ul>
        </div>
    </div>

    <div>
        <h3 class="text-center mt-5">Certifications</h3>
        <div class="container d-flex justify-content-evenly my-4 ">
            <ul id="certification" class="multi_select d-flex flex-row gap-3">
                <li class="list-unstyled btn btn-outline-success"><a href="#" data-type="certification" data-value="-18" onclick="handleFilterClick(event, 'certification', '-18')">18-</a></li>
                <li class="list-unstyled btn btn-outline-danger"><a href="#" data-type="certification" data-value="18" onclick="handleFilterClick(event, 'certification', '18')">18+</a></li>
            </ul>
        </div>

    </div>

    <div id="movies" class="films">
        <!-- Contenu des films sera affiché ici -->
    </div>
</body>

</html>