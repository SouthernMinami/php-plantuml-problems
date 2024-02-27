<?php

$problemId = $_GET['id'];
$problem = fetchProblem($problemId);
function fetchProblem($id)
{
    $problems = file_get_contents("../../public/json/problems.json");
    $problemsDecoded = json_decode($problems, true);
    // problems.jsonの問題idは0ではなく1からスタート
    return $problemsDecoded[$id - 1];
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php $problem['title'] ?>
    </title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>

<body>
    <?php include '../../Components/Layouts/header.html'; ?>
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
            <?php include '../../Components/Editors/editor.html'; ?>
            <div>
                <?php include '../../Components/Previews/preview.html'; ?>
                <?php include '../../Components/Previews/samplePreview.html'; ?>
            </div>
        </div>
    </main>
    <script>
        const problem = <?php echo json_encode($problem); ?>;
        const buttonsContaier = document.getElementById('buttons-container');
        buttonsContaier.append(sampleCodeButton(problem.answer))

        renderPreview('sample-img', problem.answer)
    </script>