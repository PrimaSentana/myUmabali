import './bootstrap';

import Alpine from 'alpinejs';
import { imageUpload } from './listings/image-upload';
import { leafletMap } from '../map/leaflet';
import { previewMap } from '../map/preview-map';
import { imageEdit } from './listings/image-edit';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    previewMap();
    imageUpload();
    imageEdit();
    leafletMap();
});