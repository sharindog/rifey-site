document.addEventListener('turbo:render', () => {
    const fields = document.querySelectorAll('[data-controller="tinymce"] textarea');

    if (!window.tinymce || fields.length === 0) return;

    fields.forEach(field => {
        if (field.classList.contains('tinymce-loaded')) return;

        field.classList.add('tinymce-loaded');

        tinymce.init({
            target: field,
            plugins: 'lists link table image code autoresize',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            height: 400,

            images_upload_handler: function (blobInfo, success, failure) {
                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                fetch('/platform/tinymce-upload', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: formData,
                    credentials: 'same-origin',
                })
                    .then(response => {
                        if (!response.ok) throw new Error('HTTP error ' + response.status);
                        return response.json();
                    })
                    .then(json => {
                        if (typeof json.location !== 'string') {
                            throw new Error('Invalid response: no "location" field');
                        }
                        success(json.location);
                    })
                    .catch(err => {
                        console.error(err);
                        failure('Ошибка загрузки: ' + err.message);
                    });
            }
        });
    });
});
