<?php
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);

$uri_segments_parameter = $uri_segments[1];
 ?>
@include('layouts.header')
@include('layouts.sidebar')
@yield('content')
@include('layouts.footer')