<?php
//   This is my sexy autoloader
//　　██░▀██████████████▀░██
//　　█▌▒▒░████████████░▒▒▐█
//　　█░▒▒▒░██████████░▒▒▒░█
//　　▌░▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒░▐
//　　░▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒░
//　 ███▀▀▀██▄▒▒▒▒▒▒▒▄██▀▀▀██
//　 ██░░░▐█░▀█▒▒▒▒▒█▀░█▌░░░█
//　 ▐▌░░░▐▄▌░▐▌▒▒▒▐▌░▐▄▌░░▐▌
//　　█░░░▐█▌░░▌▒▒▒▐░░▐█▌░░█
//　　▒▀▄▄▄█▄▄▄▌░▄░▐▄▄▄█▄▄▀▒
//　　░░░░░░░░░░└┴┘░░░░░░░░░
//　　██▄▄░░░░░░░░░░░░░░▄▄██
//　　████████▒▒▒▒▒▒████████
//　　█▀░░███▒▒░░▒░░▒▀██████
//　　█▒░███▒▒╖░░╥░░╓▒▐█████
//　　█▒░▀▀▀░░║░░║░░║░░█████
//　　██▄▄▄▄▀▀┴┴╚╧╧╝╧╧╝┴┴███
//　　██████████████████████
spl_autoload_register(function ($class) {
    $prefix = 'Leedch\\Translate\\';

    $base_dir = __DIR__ . '/src/';
    
    $len = strlen($prefix);
    
    //Does it match the prefix?
    if(strncmp($prefix, $class, $len) !== 0){
        //nope, fuck off and use a different autoloader
        return;
    }

    $relative_class = ltrim(substr($class, $len), '\\');

    //Replace namespace with directory
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    //if exists, require
    if (is_file($file)) {
        require_once $file;
    }
});