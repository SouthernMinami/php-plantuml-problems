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

    renderPreview(editor.getValue())

    editor.onDidChangeModelContent(() => {
        console.log("Model content changed")
        renderPreview(editor.getValue())
    })
})

const renderPreview = async (code) => {
    const reqJSON = {
        "code": code,
        "format": "png"
    }

    const res = await fetch('http://localhost:8000/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'text/plain'
        },
        body: JSON.stringify(reqJSON)
    })
    const data = await res.text()
    console.log(data)

    const previewImg = document.getElementById('preview-img')
    previewImg.src = data
}
