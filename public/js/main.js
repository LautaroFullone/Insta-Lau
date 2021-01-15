var url = 'http://insta-lau.test/';

window.addEventListener("load", function(){
   // $('body').css('background','red');

    //poner manito cuando pasa encima
    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    //Boton like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'img/heart-red.png');

            $.ajax({
                url: url+'imagen/dar-like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado like a la publicacion');
                    }else{
                        console.log('Error al dar like');

                    }
                }
            });
            dislike();
        });
    }
    like();

    //Boton dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'img/heart-black.png');

            $.ajax({
                url: url+'imagen/dar-dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado dislike a la publicacion');
                    }else{
                        console.log('Error al dar dislike');

                    }
                }
            });

            like();
        });
    }

    dislike();

    //BUSCADOR
    //$('#buscador').submit(function(){
    //    $(this).attr('action',url+'/listado-usuarios'+$('#buscador #search').var());
    //});
});
