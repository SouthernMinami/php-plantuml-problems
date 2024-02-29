<?php
function fetchSheets()
{
    $sheets = file_get_contents("../../public/json/sheets.json");
    $sheetsDecoded = json_decode($sheets, true);
    return $sheetsDecoded;
}

$sheets = fetchSheets();

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php $sheet['name'] ?>
    </title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>

<body>
    <?php include '../../Components/Layouts/header.html'; ?>
    <main>
        <?php foreach ($sheets as $sheet): ?>
            <div class="tab-content">
                <h1>
                    <?php echo $sheet['name'] ?>
                </h1>
                <p>
                    <?php echo $sheet['summary'] ?>
                </p>
                <div class="syntax-description">
                    <?php foreach ($sheet['descriptions'] as $description): ?>
                        <?php $id = $description['id'] ?>
                        <div class="description">
                            <h2>
                                <?php echo $description['title'] ?>
                            </h2>
                            <pre><?php echo $description['content'] ?></pre>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="sample">
                    <?php foreach ($sheet['sampleCodes'] as $sampleCode): ?>
                        <pre><?php echo $sampleCode['code'] ?></pre>
                    <?php endforeach; ?>
                    <?php foreach ($sheet['sampleImages'] as $sampleImage): ?>
                        <img src="<?php echo $sampleImage['url'] ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>

</html>

<!-- import { Sheet } from "@/app/types/types"

type Props = {
    sheet: Sheet
}

export const SheetContent = ({ sheet }: Props) => {
    const descriptions = sheet.descriptions
    const sampleCodes = sheet.sampleCodes
    const sampleImages = sheet.sampleImages

    return (
        <div className="tab-content text-left px-2 py-6 border-b border-gray">
            <h1 className="text-2xl">{sheet.name}</h1>
            <p>{sheet.summary}</p>
            <div className="syntax-descriptions px-2 py-6">
                {descriptions.map((description) => {
                    const id = description.id
                    return (
                        <div key={id} className="space-y-2">
                            <div className="description">
                                <h2 className="text-xl">{description.title}</h2>
                                <pre className="px-4">{description.content}</pre>
                            </div>
                            <div className="sample flex ">
                                <pre className="border bg-gray-100">{sampleCodes.find(sampleCode => sampleCode.id === id)?.code}</pre>
                                <img src={sampleImages.find(sampleImage => sampleImage.id === id)?.url} className="border" />
                            </div>
                        </div>
                    )
                })}
            </div>
        </div>
    )
} -->