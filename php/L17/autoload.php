<?php

function ssnd_class_autoloader($class_name)
{
    if (false === strpos($class_name, 'ssnd')) {
        return;
    }
    
    $file_parts = explode('\\', $class_name);
    
    $namespace = '';
    
    for ($i = count($file_parts) - 1; $i > 0; $i--) {
        $current = str_ireplace('_', '-', $file_parts[$i]);
        
        // If we're at the first entry, then we're at the filename.
        if (count($file_parts) - 1 === $i) {
            $file_name = "$current.php";
        } else {
            $namespace = '/html/src/' . $current . $namespace;
        }
    }
    
    $filepath = rtrim( (dirname(dirname(__FILE__)) . $namespace), '/\\' );;
    $filepath = dirname(dirname(__FILE__)) . $namespace . '/';
    
    $filepath .= $file_name;
    
    if (file_exists($filepath)) {
        include_once($filepath);
    } else {
        die(
           "The file attempting to be loaded at $filepath does not exist."
        );
    }
}