<?php
include("utils/utils.php");
$utils = new Utils();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files in Current Directory</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"> <!-- Import Css file -->
</head>

<body>
    <div class="container header">
        <button>
            <i class="fa-solid fa-house"></i>
            home
        </button>
        <div class="searchbar">
            <input type="text" id="search" placeholder="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
    <main>
        <div class="infocontent">
            <div class="directories">
                <?php foreach ($utils->sortedFiles as $file) { ?>
                    <a href='<?= $utils->check($file); ?>'> <?= $utils->icon($file) . $file ?> </a>
                <?php } ?>
            </div>
            <div class="storage">
                <progress class="progressbar" value="<?= $utils->usedSpace ?>" max="<?= $utils->totalSpace ?>">
                </progress>
                <div class="drivename">
                    <h2>
                        <i class="fa-solid fa-database"></i>&nbsp;
                        /&nbsp;
                        <span>
                            <?= $utils->usedSpaceGB . " GB / " . $utils->totalSpaceGB . " GB " ?>
                        </span>
                    </h2>
                    <p>
                        <?= $utils->percent . "%" ?>
                    </p>
                </div>
            </div>
        </div>