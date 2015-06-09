/* 
 * JavaScript para el Backend.
 * Se encarga de hacer el AJAx y lso mensajes de error/confirmacion
 * 
 */
    /*=== DIALOGOS  ===*/
    function tostada(mensaje, tipo) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-full-width",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        if (mensaje !== '') {
            if (tipo == '2') {
                toastr.warning(mensaje);

            } else if (tipo == '3') {
                toastr.error(mensaje);
            } else {
                toastr.success(mensaje);
            }
        }
    }

