<?php

require_once __DIR__ . "/vendor/autoload.php";
use function Jawira\PlantUml\encodep;

header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $data = json_decode(file_get_contents("php://input"), true);
    $uml_code = $data["code"];
    $format = $data["format"];

    $encoded = encodep($uml_code);

    echo "https://www.plantuml.com/plantuml/{$format}/{$encoded}";
} else {
    http_response_code(404);
    echo json_encode(["message" => "Not Found"]);
}
