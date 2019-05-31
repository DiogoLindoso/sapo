// JavaScript Document
alerta = {
showNotification: function(msg,type) {

        $.notify({
            icon: "nc-icon nc-notification-70",
            message: "<div class=\"col-md-5 col-lg-5\">"+msg+"</div>"

        }, {
            type: type,
            timer: 8000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
    }
}; 