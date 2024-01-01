<?php
class Autoloader
{
    // /**
    //  * The register function sets up the autoloading of classes in PHP.
    //  */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    // /**
    //  * The autoload function is responsible for dynamically loading PHP classes by converting the class
    //  * name into a file path and checking if the file exists before requiring it.
    //  * 
    //  * @param  The class parameter is the name of the class that needs to be autoloaded.
    // */
    public static function autoload($class)
    {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $baseDir = __DIR__ . '/../'; // Go back one directory from the autoload.php location

        $filePath = $baseDir . $class . '.php';
        $filePath = str_replace('App' . DIRECTORY_SEPARATOR, 'core/app/', $filePath);

        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            echo "File not found: $filePath";
        }
    }
}

Autoloader::register();
