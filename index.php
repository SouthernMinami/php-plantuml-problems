<!DOCTYPE html>
<html>

<head>
    <title>PlantUML Problems</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>
    <?php include './Components/Layouts/header.html'; ?>
    <main>
        <div class="title-container">
            <h1 class="page-title">
                Playground
            </h1>
            <p class="page-description">
                このサイトでは、開発に関する様々な図を作れるUMLを練習することが出来ます。<br />出力結果を確認しながらコーディングの練習をしてみましょう。<br />練習問題には「問題一覧」からチャレンジすることが出来ます。
            </p>
        </div>
        <div id="buttons-container" class="buttons-container">
        </div>
        <div class="content">
            <?php include './Components/Editors/editor.html'; ?>
            <?php include './Components/Previews/preview.html'; ?>
        </div>
    </main>
</body>