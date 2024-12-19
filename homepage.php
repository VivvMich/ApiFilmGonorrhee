<?php
include "base.php";
if (isset($_SESSION['name'])) {
?>
    <h1 class="red text-center">COUCOU <?= $_SESSION['name'] ?></h1>

<?php } ?>
</body>

</html>