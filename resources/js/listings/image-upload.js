export function imageUpload() {
    const input = document.getElementById('images');
    const preview = document.getElementById('preview-images');

    if (!input || !preview) return;

    const dataTransfer = new DataTransfer();

    input.addEventListener('change', () => {
        for (const file of input.files) {
            dataTransfer.items.add(file);
        }
        input.files = dataTransfer.files;
        render();
    });

    function render() {
        preview.innerHTML = '';

        Array.from(dataTransfer.files).forEach((file, index) => {
            const url = URL.createObjectURL(file);

            const wrapper = document.createElement('div');
            wrapper.className = 'relative group';

            wrapper.innerHTML = `
                <img src="${url}" class="w-full h-32 object-cover rounded-xl">
                <button type="button" class="text-white font-bold absolute top-2 right-2 rounded-full w-7 h-7">
                    ✕
                </button>
            `;

            wrapper.querySelector('button')
                .addEventListener('click', () => remove(index));

            preview.appendChild(wrapper);
        });
    }

    function remove(index) {
        const dt = new DataTransfer();
        Array.from(dataTransfer.files).forEach((f, i) => {
            if (i !== index) dt.items.add(f);
        });

        dataTransfer.items.clear();
        Array.from(dt.files).forEach(f => dataTransfer.items.add(f));

        input.files = dataTransfer.files;
        render();
    }
}
