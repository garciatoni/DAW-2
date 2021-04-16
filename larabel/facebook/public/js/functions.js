window.onload = function() { init(); };
var wisper = true;

function init() {
    var script_tag = document.getElementById('functions')
    var user_id = script_tag.getAttribute("user-id");
    var user_name = script_tag.getAttribute("user-name");


    Echo.private('Muro')
        //private -> PARA CANAL PRIVADO, CAMBIAR TAMBIEN EN MUROEVENT.
        //channel -> PARA CANALES PUBLICOS, CAMBIAR TAMBIEN EL MuroEvent.
    .listen('MuroEvent', (e) => {
        if (e.mensaje.imagen != null) {
            let divImagen  = ' <div class="bg-gray-100 border container rounded mb-2"> <p class="font-weight-bold pt-2">'+e.mensaje.user+'</p> <p class="">'+e.mensaje.mensaje+'</p> <img class="pb-3" src="https:\/\/dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/storage/app/public/'+e.mensaje.imagen+'"> <div class="border-top container justify-content-center row m-0"> <button id="meGusta" value="'+e.mensaje.id+'" class="row justify-content-center align-items-center mr-2 col-6 p-2"><p class="m-0 pl-1">Me gusta</p> </button><button id="mostrarComentarios" class="row justify-content-center align-items-center ml-2 col-6 p-2"><i class="fas fa-comment-dots fa-1x" id="'+e.mensaje.id+'"></i>  <p class="m-0 pl-1">Comenta</p></button></div><div id="comentarios" class="border-top" style="display: none"><form action="{{route(\'comentario\')}}" method="post"> <input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><div class="input-group mt-3 mb-3"><input type="text" class="form-control" placeholder="Escribe tu comentario" name="comentario" id="comentario'+e.mensaje.id+'" aria-label="Recipients" username" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-outline-secondary" id="sendComentario" value="'+e.mensaje.id+'" type="button">Enviar</button></div></div></form><div id="caja'+e.mensaje.id+'"></div></div></div>';
            $('#chat').prepend(divImagen);
        } else {
            let divSinImagen  = ' <div class="bg-gray-100 border container rounded mb-2"> <p class="font-weight-bold pt-2">'+e.mensaje.user+'</p> <p class="">'+e.mensaje.mensaje+'</p> <div class="border-top container justify-content-center row m-0"> <button id="meGusta" value="'+e.mensaje.id+'" class="row justify-content-center align-items-center mr-2 col-6 p-2"><p class="m-0 pl-1">Me gusta</p> </button><button id="mostrarComentarios" class="row justify-content-center align-items-center ml-2 col-6 p-2"><i class="fas fa-comment-dots fa-1x" id="'+e.mensaje.id+'"></i>  <p class="m-0 pl-1">Comenta</p></button></div><div id="comentarios" class="border-top" style="display: none"><form action="{{route(\'comentario\')}}" method="post"> <input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><div class="input-group mt-3 mb-3"><input type="text" class="form-control" placeholder="Escribe tu comentario" name="comentario" id="comentario'+e.mensaje.id+'" aria-label="Recipients" username" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-outline-secondary" id="sendComentario" value="'+e.mensaje.id+'" type="button">Enviar</button></div></div></form><div id="caja'+e.mensaje.id+'"></div></div></div>';
            $('#chat').prepend(divSinImagen);
        }
    });


 


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#send').click(function() {
    $('#formularioFoto').submit(function(e) {
        e.preventDefault();
        if ($('#mensaje').val() != "") {
            let mensaje = $('#mensaje').val();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/public/mensaje/send",
                data: formData,
                mensaje: mensaje,
                contentType: false,
                processData: false,
            });
            // var foto = new FormData($('#formularioFoto')[0]);
            // console.log(foto);
            // $.ajax({
            //     url: "https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/public/mensaje/send",
            //     method: 'POST',
            //     headers: { 'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")},
            //     data: {
            //         'mensaje': $('#mensaje')
            //     },
            //     processData: false,
            //     contentType: false

            // }).done(function(){
            //     alert(mensaje);
            // });

            // 
            //     $.post("https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/public/mensaje/send", {
            //         mensaje: $('#mensaje').val(),
            //         _token: $("meta[name='csrf-token']").attr("content")
            //     })
            $('#mensaje').val("");
        }
    });


    //comentarios
    $(document).on('click', '#sendComentario', function() {
        let $mensaje = $('#comentario' + $(this).val()).val();
        if ($mensaje != "") {
            $.post("https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/public/comentario/send", { mensaje: $mensaje, _token: $("meta[name='csrf-token']").attr("content"), id: $(this).val() })
            $('#comentario' + $(this).val()).val("");
            let caja = "<div class=\"col border mt-2 mb-2 bg-white\"><p class=\"m-0 font-weight-bold \">" + user_name + "</p> <p class=\"m-0\">" + $mensaje + "</p></div>";
            $('#caja' + $(this).val()).prepend(caja);
        }
    });

    //chat privado
    $(document).on('click', '#sendPrivado', function() {
        if (toUserId != null) {
            if ($('#mensajePrivado' + toUserId).val() != "") {
                $.post("https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/public/mensajePrivado/send", { mensaje: $('#mensajePrivado' + toUserId).val(), _token: $("meta[name='csrf-token']").attr("content"), to: toUserId });
                $('#mensajesPrivados' + toUserId).append("<div class=\"text-right\">" + $('#mensajePrivado' + toUserId).val() + "</div>");
                $('#mensajePrivado' + toUserId).val("");
            }
        }
    });

    //likes
    $(document).on('click', '#meGusta', function() {
        var id_publicacion = $(this).val();
        $.post("https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/public/like", { id_publicacion: id_publicacion, _token: $("meta[name='csrf-token']").attr("content") });
        if ($('#corazon' + id_publicacion).val() == undefined) {
            $(this).prepend('<i class="fas fa-heart fa-2x" id="corazon' + id_publicacion + '"></i>');
        } else {
            $(this).children().first().remove();
        }


    });



    Echo.private('user.' + user_id)
        .listen('NewMensajeNotification', (e) => {
            $('#mensajesPrivados' + e.mensaje.from).append("<div class=\"text-left\">" + e.mensaje.mensaje + "</div>");


        });



    var toUserId = null;
    $(document).on('click', '.botonChatPrivado', function() {
        toUserId = $(this).val();
        $('#bonito').children().fadeOut();
        $('#divChatPrivado' + toUserId).delay(400).fadeIn();
        $('#notificacion'+toUserId).html("");

    });

    $(document).on('click', '#mostrarComentarios', function() {
        let $div = $(this).parent().parent();
        $div.children().last().toggle();
    });




    var conectado = 1;
    //CANALES DE PRESENCIA(MIRAR SI ESTA ONLINE O NO)
    Echo.join('Online')
        .here((users) => {
            users.forEach(function(user) {
                $('#user' + user.id).parent().css('background-color', '#00FF8F');
            });
        })
        .joining((user) => {
            conectado = 1;
            $('#user' + user.id).parent().css('background-color', '#00FF8F');
        })
        .leaving((user) => {
            conectado = 0;
            setTimeout(function() {
                if (conectado == 0) {
                    $('#user' + user.id).parent().css('background-color', '#f8f9fa');
                }
            }, 1000);
        });



    //WISPERING
    $('#mensaje').keydown(function(e) {
        if (wisper) {
            Echo.private('Muro')
                .whisper('typing', {
                    name: user_name,
                });
            wisper = false;
            setTimeout(function() {
                wisper = true;
            }, 5000);
        }
    });
    Echo.private('Muro')
        .listenForWhisper('typing', (e) => {
            document.title = e.name + ' esta escribiendo...';
            setTimeout(function() {
                document.title = 'Muro';
            }, 5000);
        });


  


    // Wispering privado
    var wisperPrivado = true;
    $(document).on('keydown', '.mensajePrivado', function(e) {
        if (wisperPrivado) {
            Echo.private('user.' + toUserId)
            .whisper('wisper', {
                name: user_name,
                id: user_id
            });
            wisperPrivado = false;
            setTimeout(function() {
                wisperPrivado = true;
            }, 2000);
        }
    });
    Echo.private('user.'+ user_id)
        .listenForWhisper('wisper', (e) => {
            $('#wispering'+e.id).html(e.name+' esta escribiendo...');
            setTimeout(function() {
                $('#wispering'+e.id).html('');
            }, 2000);
        });




    // NOTIFICACION
    $(document).on('change', '.mensajePrivado', function(e) {
            console.log('entra');
            Echo.private('user.' + toUserId)
            .whisper('notificacion', {
                name: user_name,
                id: user_id
            });
        
    });
    Echo.private('user.'+ user_id)
        .listenForWhisper('notificacion', (e) => {
            alert(e.name + "te ha escrito!");
            if(toUserId != e.id){
                if($('#notificacion'+e.id).html() == ""){
                    $('#notificacion'+e.id).html(1);
                }else{
                    let numero = parseInt($('#notificacion'+e.id).html(), 10) + 1;
                    $('#notificacion'+e.id).html(numero);
                }
            }
        });
}



