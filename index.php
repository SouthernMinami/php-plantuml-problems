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
            <h1 class="title">
                Playground
            </h1>
            <p class="title-description">
                学んだUMLをこのエディタで練習してみましょう。<br />練習問題には「問題一覧」からチャレンジすることが出来ます。</p>
        </div>
        <div className="button-container">
            <button id="svgBtn" class="format-btn">
                svg
            </button>
            <button id="pngBtn" class="format-btn">
                png
            </button>
            <button id="asciiBtn" class="format-btn">
                ascii
            </button>
            <a href="#" download>
                <button id="download" class="download-btn">
                    Download
                </button>
            </a>
        </div>
        <div class="content">
            <?php include './Components/Editors/editor.html'; ?>
            <?php include './Components/Previews/preview.html'; ?>
        </div>
    </main>
</body>