
    class ImageUploader {
        constructor(config) {
            // Config berisi ID dari element HTML yang dibutuhkan
            this.inputElement = document.getElementById(config.inputId);
            this.previewNewElement = document.getElementById(config.previewNewId);
            this.previewOldElement = document.getElementById(config.previewOldId);
            this.removedInputElement = document.getElementById(config.removedInputId);
            
            // State internal
            this.dataTransfer = new DataTransfer(); // Untuk manipulasi file baru
            this.removedImages = new Set(); // Untuk nyimpen ID gambar lama yang dihapus

            // Jalankan listener jika elementnya ada
            if (this.inputElement) this.initNewImageListener();
            if (this.previewOldElement) this.initOldImageListener();
        }

        // --- Logic untuk Gambar Baru (Upload) ---
        initNewImageListener() {
            this.inputElement.addEventListener('change', () => {
                for (const file of this.inputElement.files) {
                    this.dataTransfer.items.add(file);
                }
                // Sync files input dengan DataTransfer
                this.inputElement.files = this.dataTransfer.files; 
                this.renderNewImages();
            });
        }

        renderNewImages() {
            this.previewNewElement.innerHTML = ''; // Reset container

            Array.from(this.dataTransfer.files).forEach((file, index) => {
                const url = URL.createObjectURL(file);
                
                // UI Preview
                const wrapper = document.createElement('div');
                wrapper.className = 'relative group'; // Sesuaikan styling tailwind

                wrapper.innerHTML = `
                    <img src="${url}" class="w-full h-32 object-cover rounded-xl">
                    <button type="button" class="text-white font-bold absolute top-2 right-2 rounded-full w-7 h-7">
                        ✕
                    </button>
                `;

                // Tombol Hapus Gambar Baru
                wrapper.querySelector('button').addEventListener('click', () => {
                    this.removeNewImage(index);
                });

                this.previewNewElement.appendChild(wrapper);
            });
        }

        removeNewImage(index) {
            const dt = new DataTransfer();
            // Masukkan ulang file kecuali yang index-nya dihapus
            Array.from(this.dataTransfer.files).forEach((file, i) => {
                if (i !== index) dt.items.add(file);
            });

            // Update state dan input asli
            this.dataTransfer = dt;
            this.inputElement.files = this.dataTransfer.files;
            this.renderNewImages();
        }

        // --- Logic untuk Gambar Lama (Database) ---
        initOldImageListener() {
            this.previewOldElement.addEventListener('click', (e) => {
                // Cek apakah yang diklik adalah tombol hapus atau child dari tombol hapus
                const btn = e.target.closest('.remove-existing-btn');
                if (!btn) return;

                const wrapper = btn.closest('.image-item');
                const imageId = wrapper.dataset.id;

                // Masukkan ID ke hidden input "removed_images"
                if (imageId) {
                    this.removedImages.add(imageId);
                    // Update value input hidden dalam bentuk JSON Array
                    this.removedInputElement.value = JSON.stringify([...this.removedImages]);
                }

                // Hapus element dari DOM
                wrapper.remove();
            });
        }
    }
    window.ImageUploader = ImageUploader;
