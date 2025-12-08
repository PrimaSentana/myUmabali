import './bootstrap';

import Alpine from 'alpinejs';
import { previewMap } from './map/preview-map';
import { leafletMap } from './map/leaflet';
import { imageUpload } from './listings/image-upload';
import { imageEdit } from './listings/image-edit';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    previewMap();
    leafletMap();
    imageUpload();
    imageEdit();
});