export function imageUploadProfile() {
    const input = document.getElementById('image_profile');
    const preview = document.getElementById('preview-profile');

    if(!input || !preview) return;

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
        wrapper.className = 'relative group flex items-center gap-2';
        wrapper.innerHTML = `
            <div class="flex">
                <img src="${url}" class="object-cover rounded-full block w-24 h-24">
                <button type="button" class="font-bold rounded-full w-2 h-2">
                    ✕
                </button>
            </div>
            <p class="text-sm text-gray-400">preview</p>
        `;

        wrapper.querySelector('button').addEventListener('click', remove);
        preview.appendChild(wrapper);

    }

    function remove() {
        input.value = '';
        preview.innerHTML = '';
    }
}