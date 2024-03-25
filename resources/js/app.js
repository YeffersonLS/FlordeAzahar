require('./bootstrap');

import 'chosen-js';

function iniciarCarga(){
    $(".cargando").fadeIn(200);
}
function detenerCarga(){
    $(".cargando").fadeOut(100);
}
