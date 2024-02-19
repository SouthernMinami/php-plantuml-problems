<!DOCTYPE html>
<html>

<head>
    <title>PlantUML Problems</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="title-container">
            <h1 class="title">
                Playground
            </h1>
            <p class="title-description">
                学んだUMLをこのエディタで練習してみましょう。<br />練習問題には「問題一覧」からチャレンジすることが出来ます。</p>
        </div>
        <div className="button-container flex justify-center my-4">
            <button id="svgBtn" class="format-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                svg
            </button>
            <button id="pngBtn" class="format-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                png
            </button>
            <button id="asciiBtn"
                class="format-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                ascii
            </button>
            <a href="#" download>
                <button id="download"
                    class="download-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Download
                </button>
            </a>
        </div>
        <div class="content flex justify-center">
            <?php include 'editor.php'; ?>
            <?php include 'preview.php'; ?>
        </div>
    </main>
</body>