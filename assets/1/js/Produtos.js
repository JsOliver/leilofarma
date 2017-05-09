function categoria(base,tipo,page,scroll,bpg,resutblock,keyword,pg1,details) {
    if(scroll == 1) {
        $("#Loading").html('<h1 style="left: 40%;top: 50%;position: fixed;z-index: 100;">Carregando...</h1>');
    }


    $.ajax({
        type: "POST",
        url: base+'AjaxControler/'+bpg,
        data: {tipo: tipo,page:page,resutblock:resutblock,keyword:keyword,pg1:pg1,details:details},
        success: function (result) {
            $("#"+resutblock+"").html(result);
            $("#Loading").html('');

        },
        error: function (result) {
            alert('erro');

        }
    });

    if(scroll == 1){

        if(tipo == 21 || tipo == 22 || tipo == 23){
            $('body,html').animate({
                scrollTop: 200
            }, 100);
        }

        if(tipo == 31)
        {
            $('body,html').animate({
                scrollTop: 200
            }, 800);

        }
        if(tipo == 32)
        {
            $('body,html').animate({
                scrollTop: 200
            }, 800);

        }
        if(tipo == 41)
        {
            $('body,html').animate({
                scrollTop: 200
            }, 800);

        }

        else{

            $('body,html').animate({
                scrollTop: 300
            }, 800);
        }

    }


    return false;
}