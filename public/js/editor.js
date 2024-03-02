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
        renderPreview('preview-img', currCode)
    })

    formats.forEach(format => {
        const formatBtn = formatButton(format)
        formatBtn.addEventListener('click', () => {
            currFormat = format
            renderPreview('preview-img', editor.getValue())
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

const sampleCodeButton = (code) => {
    const pre = document.getElementById('sample-code')
    const button = document.createElement('button')
    button.id = 'sample-code-btn'
    button.classList.add('sample-code-btn')
    button.innerText = 'サンプルコードを表示'

    button.addEventListener('click', () => {
        if (button.textContent === 'サンプルコードを表示') {
            pre.innerHTML = code
            pre.style.display = 'block'
            button.textContent = 'サンプルコードを非表示'
        } else {
            pre.style.display = 'none'
            button.textContent = 'サンプルコードを表示'
        }
    })

    return button
}

const renderPreview = async (imgId, code) => {
    const reqJSON = {
        "code": code,
        "format": currFormat
    }

    const res = await fetch('/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'text/plain'
        },
        body: JSON.stringify(reqJSON)
    })

    const data = await res.text()
    const img = document.getElementById(imgId)

    if (currFormat === "txt") {
        const ascii = await getAscii(data)
        img.src = ""
        img.innerHTML = `<pre>${ascii}</pre>`
    } else img.src = data
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
        const res = await fetch('/api.php', {
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

