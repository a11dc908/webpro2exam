<?php

function redirect_to($filename) {
    $host = $_SERVER['HTTP_HOST'];
    $dir  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    header('HTTP/1.1 301 Moved Permanently');
    header("Location:http://${host}${dir}/${filename}");
}