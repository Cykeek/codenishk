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
                <?php
                $directory = '../';
                $hiddenFolder = 'cloudnishk';
                $files = scandir($directory);
                $files = array_diff($files, array('.', '..', $hiddenFolder));
                // Get total and free space
                $totalSpace = disk_total_space($directory);
                $freeSpace = disk_free_space($directory);

                // Calculate used space
                $usedSpace = $totalSpace - $freeSpace;

                // Convert bytes to gigabytes for easier readability
                $totalSpaceGB = round($totalSpace / (1024 * 1024 * 1024), 2); // Total space in GB
                $freeSpaceGB = round($freeSpace / (1024 * 1024 * 1024), 2); // Free space in GB
                $usedSpaceGB = round($usedSpace / (1024 * 1024 * 1024), 2); // Used space in GB
                
                // Separate folders and files
                $folders = [];
                $regularFiles = [];

                foreach ($files as $file) {
                if (is_dir($directory . $file)) {
                $folders[] = $file; // Add to folders array
                } else {
                $regularFiles[] = $file; // Add to files array
                }
                }

                // Sort folders and files
                sort($folders);
                sort($regularFiles);

                // Merge folders and files
                $sortedFiles = array_merge($folders, $regularFiles);

                foreach ($sortedFiles as $file) {
                echo "<a href=''>".$file."</a>";
                }
                ?>
            </div>
            <div class="storage">
                <progress class="progressbar" value="<?= $usedSpace?>" max="<?= $totalSpace?>">
                </progress>
                <div class="drivename">
                    <h2>
                        <i class="fa-solid fa-database"></i>&nbsp;
                        C:&nbsp;
                        <span>
                            <?php

                            echo $usedSpaceGB." GB / ".$totalSpaceGB." GB ";
                            ?>
                        </span>
                    </h2>
                    <p>
                        <?php
                            $percent = round(($usedSpace / $totalSpace) * 100);
                            echo $percent."%";
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="content">

        </div>
    </main>
</body>

</html>