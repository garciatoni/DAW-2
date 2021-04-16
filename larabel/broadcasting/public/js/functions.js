window.onload = function() { init(); };

function init(){
    var script_tag = document.getElementById('functions')
    var user_id = script_tag.getAttribute("user-id");

    Echo.private('user.'+user_id)

    .listen('NewMensajeNotification', (e) => {
        alert(e.mensaje.mensaje);
    });
}