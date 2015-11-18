new MediumEditor('.compasshb-editor', {
    anchorInputPlaceholder: 'Type a link',
    buttons: ['bold', 'italic', 'quote', 'removeFormat'],
    diffLeft: 25,
    diffTop: 10,
    firstHeader: 'h1',
    secondHeader: 'h2',
    delay: 1000,
    targetBlank: true,
    paste: {
        cleanPastedHTML: true,
        cleanAttrs: ['style', 'dir'],
        cleanTags: ['label', 'meta']
    }
});