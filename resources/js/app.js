import './bootstrap';

import Alpine from 'alpinejs';
import { previewMap } from './map/preview-map';
import { leafletMap } from './map/leaflet';
import { imageUpload } from './listings/image-upload';
import { imageUploadCover } from './listings/image-cover';
import { imageUploadKamar } from './listings/image-kamar';
import { imageUploadProfile } from './listings/image-profile';
import './listings/image-edit-handler';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    imageUploadCover();
    imageUploadKamar();
    imageUploadProfile();
    previewMap();
    leafletMap();
    imageUpload();
});

flatpickr('#date_range', {
    mode: 'range',
    dateFormat: 'd-M-Y',
    minDate: new Date().fp_incr(1),
    disableMobile: true
});

window.openModal = function(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex')
}

window.closeModal = function(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

document.getElementById('pay-button').addEventListener('click', function () {
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            console.log(result);
        },
        onPending: function(result){
            console.log(result);
        },
        onError: function(result){
            console.log(result);
        }
    });
});
