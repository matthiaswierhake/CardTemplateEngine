document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.club-image-field').forEach(function (field) {

        const selectButton = field.querySelector('.club-image-select');
        const removeButton = field.querySelector('.club-image-remove');
        const input = field.querySelector('.club-image-id');
        const preview = field.querySelector('.club-image-preview');

        if (!selectButton || !input || !preview) {
            return;
        }

        selectButton.addEventListener('click', function (event) {
            event.preventDefault();

            const frame = wp.media({
                title: 'Bild auswählen',
                button: {
                    text: 'Bild verwenden'
                },
                multiple: false
            });

            frame.on('select', function () {
                const attachment = frame.state().get('selection').first().toJSON();

                input.value = attachment.id;

                const imageUrl =
                    attachment.sizes && attachment.sizes.medium
                        ? attachment.sizes.medium.url
                        : attachment.url;

                preview.innerHTML = '<img src="' + imageUrl + '" alt="">';
            });

            frame.open();
        });

        if (removeButton) {
            removeButton.addEventListener('click', function (event) {
                event.preventDefault();

                input.value = '';
                preview.innerHTML = '<span>Kein Bild ausgewählt</span>';
            });
        }

    });
});