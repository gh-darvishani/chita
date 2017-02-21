<?php
/**
 * Project specific psr-4 autoloader
 * Based on example https://github.com/php-fig/fig-standards/blob/master/proposed/psr-4-autoloader/psr-4-autoloader-examples.md
 *
 * @param string $class The fully-qualified class name.
 *
 * @return void
 */
require_once 'src/User.php';
require_once 'src/UserBase.php';
require_once 'src/Collection.php';
require_once 'src/Cookie.php';
require_once 'src/DB.php';
require_once 'src/DB_Table.php';
require_once 'src/Hash.php';
require_once 'src/LinkedCollection.php';
require_once 'src/Log.php';
require_once 'src/Session.php';
spl_autoload_register(
    function ($class){

        // project-specific namespace prefix
        $prefix = 'ptejada\\uFlex\\';

        // base directory for the namespace prefix
        $base_dir = __DIR__ . '/src/';

        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }

        // get the relative class name
        $relative_class = substr($class, $len);

        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
);