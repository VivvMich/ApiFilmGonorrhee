<?php
include "base.php";
if (isset($_SESSION['name'])) {
?>
    <h1 class="red text-center">COUCOU <?= $_SESSION['name'] ?></h1>

<?php } ?>

<div id="thanos">
    <div id="container2">
        <img src="popcorn2.png" id="original-image" alt="seau de popcorn">

    </div>
    <h1 class="text-light">"Plongez dans l'univers du cinéma, une histoire à chaque instant."</h1>
</div>

</body>

</html>