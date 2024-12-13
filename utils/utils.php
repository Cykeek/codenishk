<?php
class Utils
{
    public $path;

    public $directory = '../';

    public $sortedFiles;

    public $totalSpace;
    public $usedSpace;
    public $totalSpaceGB;
    public $usedSpaceGB;
    public $percent;

    public $readfiles=[];

    function __construct()
    {
        // Initialize the class here
        // $this->path = $_SERVER['REQUEST_URI'];
        if (isset($_GET['dir'])){
            $this->get_path();
        }
        $this->root_files();
        $this->calc_space();
    }

    private function root_files()
    {
        $files = $this->dirscan($this->directory, 'cloudnishk');


        foreach ($files as $file) {
            if (is_dir($this->directory . $file)) {
                $folders[] = $file; // Add to folders array
            } else {
                $regularFiles[] = $file; // Add to files array
            }
        }

        // Sort folders and files
        sort($folders);
        sort($regularFiles);

        $this->sortedFiles = array_merge($folders, $regularFiles);
    }

    private function calc_space()
    {
        // Get total and free space
        $this->totalSpace = disk_total_space($this->directory);
        $freeSpace = disk_free_space($this->directory);

        // Calculate used space
        $this->usedSpace = $this->totalSpace - $freeSpace;

        // Convert bytes to gigabytes for easier readability
        $this->totalSpaceGB = round($this->totalSpace / (1024 * 1024 * 1024), 2);
        $this->usedSpaceGB = round($this->usedSpace / (1024 * 1024 * 1024), 2);

        $this->percent = round(($this->usedSpace / $this->totalSpace) * 100);
    }

    public function icon($file)
    {
        $icon = is_dir($this->directory . $file) ? '<i class="fa-solid fa-folder"></i>' : '<i class="fa-solid fa-file"></i>';
        return $icon;
    }

    public function check($file)
    {
        return is_dir($this->directory . $file) ? '?dir=' . $file : '?file=' . $file;
    }

    private function dirscan($dirname, $hide = '')
    {
        $files = scandir($dirname);
        $files = array_filter($files, function ($file) {
            return $file[0] !== '.'; // Exclude files and folders that start with a dot
        });
        if ($hide == '') {
            return $files;
        }
        $files = array_diff($files, array('.', '..', $hide));
        return $files;
    }

    private function get_path()
    {
        if (empty($this->readfiles)) {
            $foldername = $this->directory.$_GET['dir'];
        }
        else {
            $foldername = $this->directory.$this->readfiles.$_GET['dir'];
        }
        $this->readfiles = $this->dirscan($foldername);
    }
    
}