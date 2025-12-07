import './bootstrap';

import Alpine from 'alpinejs';
import { imageUpload } from './listings/image-upload';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    imageUpload();
});