export function imageUploadCover() {
    const input = document.getElementById('image_cover');
    const preview = document.getElementById('preview-cover');

    if (!input || !preview) {
        return;
    }

    input.addEventListener('change', () => {
        render();
    });

    function render() {
        preview.innerHTML = '';
        const file = input.files[0];
        if(!input) {
            return;
        }
        const url = URL.createObjectURL(file);

        const wrapper = document.createElement('div');
        wrapper.className = 'relative group';
        wrapper.innerHTML = `
            <img src="${url}" class="w-full h-32 object-cover rounded-xl">
            <button type="button" class="text-white font-bold absolute top-2 right-2 rounded-full w-7 h-7">
                ✕
            </button>
        `;

        wrapper.querySelector('button').addEventListener('click', remove);
        preview.appendChild(wrapper);

    }

    function remove() {
        input.value = '';
        preview.innerHTML = '';
    }
}