<?php

function fetchProblems()
{
    $problems = file_get_contents("../../public/json/problems.json");
    return json_decode($problems, true);
}

$problems = fetchProblems();
define('PROBLEMS_PER_PAGE', 5);
define('PAGE_COUNT', ceil(count($problems) / PROBLEMS_PER_PAGE));

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$indexOfLastProblem = $currentPage * PROBLEMS_PER_PAGE;
$indexOfFirstProblem = $indexOfLastProblem - PROBLEMS_PER_PAGE;

// $currentProblems = array_slice($problems, $indexOfFirstProblem, PROBLEMS_PER_PAGE);
$currentProblems = $problems;
?>
<!DOCTYPE html>
<html>

<head>
    <title>PlantUML Problems</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>

<body>
    <?php include '../../Components/Layouts/header.html'; ?>
    <main>
        <div class="table">
            <div class="table-head">
                <div class="th">
                    問題ID
                </div>
                <div class="th">
                    タイトル
                </div>
                <div class="th">
                    難易度
                </div>
                <div class="th">
                    カテゴリー
                </div>
            </div>
            <div class="table-body">
                <?php foreach ($currentProblems as $problem):
                    echo '<a href="/Pages/Problems/problem.php?id=' . $problem['id'] . '" class="table-row">';
                    echo '<div class="td">';
                    echo $problem['id'];
                    echo '</div>';
                    echo '<div class="td">';
                    echo $problem['title'];
                    echo '</div>';
                    echo '<div class="td">';
                    echo $problem['difficulty'];
                    echo '</div>';
                    echo '<div class="td">';
                    echo $problem['category'];
                    echo '</div>';
                    echo '</a>';
                endforeach; ?>
            </div>
        </div>
        <div class="pagination">
            <?php foreach (range(1, PAGE_COUNT) as $number):
                $is_current_page = $number == $currentPage;
                $rounded = $number === 1 ? 'rounded-l' : ($number === PAGE_COUNT ? 'rounded-r' : '');
                $bg_color = $is_current_page ? 'bg-blue-500' : 'bg-gray-500';

                echo '<a href="?page=' . $number . '" class="pagination-btn ' . $bg_color . ' ' . $rounded . '">';
                echo $number;
                echo '</a>';
            endforeach; ?>
        </div>
</body>
</main>


</html>