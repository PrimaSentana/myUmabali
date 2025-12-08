export function imageEdit() {
    const preview = document.getElementById('image-preview');
    const removedImages = new Set();
    let selectedFiled = [];

    preview.addEventListener('click', function (e) {
        if(!e.target.classList.contains('remove-image')) return;

        const wrapper = e.target.closest('.image-item');

        // image lama
        if (wrapper.dataset.existing === 'true') {
            removedImages.add(wrapper.dataset.id);
            document.getElementById('removed-images').value = JSON.stringify([...removedImages]);
        }

        wrapper.remove();
    });
}