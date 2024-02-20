const buttonsContainer = document.getElementById('buttons-container')
const formats = ["png", "svg", "txt"]
let currFormat = "png"
let currCode = '@startuml\n\tBob -> Alice : hello\n@enduml'

require.config({
    paths: {
        'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs'
    }
})

require(['vs/editor/editor.main'], () => {
    const editor = monaco.editor.create(document.getElementById('editor'), {
        value: [
            '@startuml',
            '\tBob -> Alice : hello',
            '@enduml'
        ].join('\n'),
        language: 'plaintext',
        automaticLayout: true,
        theme: 'vs-dark'
    })

    editor.onDidChangeModelContent(() => {
        currCode = editor.getValue()
        renderPreview(currCode)
    })

    formats.forEach(format => {
        const formatBtn = formatButton(format)
        formatBtn.addEventListener('click', () => {
            currFormat = format
            renderPreview(editor.getValue())
        })
        buttonsContainer.append(formatBtn)
    })
    const downloadBtn = downloadButton()
    buttonsContainer.append(downloadBtn)
})

const formatButton = (format) => {
    const button = document.createElement('button')
    button.id = format
    button.classList.add('format-btn')
    if (format === currFormat) {
        button.classList.add('active')
    }
    button.innerText = format
    return button
}

const downloadButton = () => {
    const button = document.createElement('button')
    button.id = 'download'
    button.classList.add('download-btn')
    button.innerText = `Download ${currFormat} file`
    button.addEventListener('click', () => {
        downloadImage(currFormat, currCode)
    })

    return button
}

const renderPreview = async (code) => {
    const reqJSON = {
        "code": code,
        "format": currFormat
    }

    const res = await fetch('http://localhost:8000/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'text/plain'
        },
        body: JSON.stringify(reqJSON)
    })

    const data = await res.text()
    const previewImage = document.getElementById('preview-img')


    if (currFormat === "txt") {
        const ascii = await getAscii(data)
        console.log(ascii)
        previewImage.src = ""
        previewImage.innerHTML = `<pre>${ascii}</pre>`
    } else previewImage.src = data
}

const getAscii = async (url) => {
    try {
        const response = await fetch(url);
        const data = await response.text();
        return data;
    } catch (error) {
        console.error(error);
    }
}
const downloadImage = async (format, code) => {
    try {
        const res = await fetch('http://localhost:8000/api.php', {
            method: 'POST',
            body: JSON.stringify({
                "code": code,
                "format": format
            }),
            headers: {
                'Content-Type': 'text/plain'
            },
        })


        const url = await res.text();

        const blob = await getContentBlob(url);
        if (blob) {
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = `plant-uml.${format}`;
            a.click();
        }
    } catch (error) {
        console.error(error);
    }
}

const getContentBlob = async (url) => {
    try {
        const res = await fetch(url);
        const blob = await res.blob();
        return blob;
    } catch (error) {
        console.error(error);
        return null;
    }
}

