<?php
$path = @parse_url($_SERVER['REQUEST_URI'])['path'];
switch ($path) {
    case '/':                   
        require 'login.php';
        break;
    case '/login.php':
        require 'login.php';
        break;
    case '/pokemonform.php':
        require 'pokemonform.php';
        break;
    case '/myprofile.php':
        require 'myprofile.php';
        break;
    case '/add-patient.php':
        require 'add-patient.php';
        break;
    case '/patient-search.php':
        require 'patient-search.php';
        break;
    case '/nursesearch.php':
        require 'nursesearch.php';
        break;
    case '/pokemon_details.php':
        require 'pokemon_details.php';
        break;
    case '/logout.php':
        require 'logout.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
    }
?>