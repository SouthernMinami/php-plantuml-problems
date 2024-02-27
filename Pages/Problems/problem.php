<?php

$problemId = $_GET['id'];
$problem = fetchProblem($problemId);
function fetchProblem($id)
{
    $problems = file_get_contents("../../public/json/problems.json");
    $problemsDecoded = json_decode($problems, true);
    return $problemsDecoded[$id - 1];
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>PlantUML Problems</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>

<body>

    <head>
        <title>PlantUML Problems</title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
    </head>

    <body>
        <?php include './Components/Layouts/header.html'; ?>
        <main>
            <div class="title-container">
                <h1 class="page-title">
                    <?php echo $problem['id'] . ': ' . $problem['title'] ?>
                </h1>
                <p class="page-description">

            </div>
            <div id="buttons-container" class="buttons-container">
            </div>
            <div class="content">
                <?php include './Components/Editors/editor.html'; ?>
                <?php include './Components/Previews/preview.html'; ?>
            </div>
        </main>
    </body>