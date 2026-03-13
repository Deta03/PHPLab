<?php

declare(strict_types=1);

$dir = "image/";
$files = scandir($dir);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Cars Gallery</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>
    <nav>
        <a href="#">About Cars</a> |
        <a href="#">News</a> |
        <a href="#">Contacts</a>
    </nav>
</header>

<main>

    <h1>#cars</h1>
    <p class="subtitle">Explore a world of cars</p>

    <div class="gallery">

        <?php

        if ($files !== false) {

            for ($i = 0; $i < count($files); $i++) {

                if ($files[$i] != "." && $files[$i] != "..") {

                    $path = $dir . $files[$i];

                    echo "<div class='card'>";
                    echo "<img src='$path' alt='cat'>";
                    echo "</div>";
                }
            }
        }

        ?>

    </div>

</main>

<footer>
    <p>USM © 2026</p>
</footer>

</body>
</html>