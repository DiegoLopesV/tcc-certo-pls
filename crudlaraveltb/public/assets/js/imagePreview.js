function setupImagePreview(inputId, previewId) {
    document.getElementById(inputId).addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

setupImagePreview('foto', 'imagePreview');
setupImagePreview('fotoEditar', 'imagePreviewEditar');
