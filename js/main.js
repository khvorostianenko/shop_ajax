function ableOrDisableForm(classparam, idparam){

    if ($('#'+idparam).prop("checked")) {
        $('.' + classparam).removeAttr('disabled');
    } else {
        $('.' + classparam).attr('disabled', true);
    }
}

function forNewDom(param, targ, hr)
{
        $("a.menu").removeAttr(targ);
        $("a.menu").removeAttr(hr);
        var id=param;
        url='url='+id+'.html';
        request = new AjaxRequest();
        request.open("POST", "php/poster.php", true);
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.setRequestHeader("Content-length", url.length);
        request.setRequestHeader("Connection", "close");
        request.onreadystatechange = function()
        {
            if (this.readyState == 4)
            {
                if (this.status == 200)
                {
                    if (this.responseText != null)
                    {
                        $('#for-new-dom').html(this.responseText);
                    }
                    else alert("Ошибка AJAX: Данные не получены");
                }
                else alert( "Ошибка AJAX: " + this.statusText);
            }
        };
        $('footer').css('display', 'none');
        request.send(url);
        $('footer').css('display', 'block');
}

function AjaxFormRequest(result_id,form_id,url) {
    jQuery.ajax({
        url:     url, //Адрес подгружаемой страницы
        type:     "POST", //Тип запроса
        dataType: "html", //Тип данных
        data: jQuery("#"+form_id).serialize(),
        success: function(response) { //Если все нормально
            $('#'+result_id).html(response);
        },
        error: function(response) { //Если ошибка
            $('#'+result_id).html("Ошибка при отправке формы");
        }
    });
}

function AjaxRequest()
{
    try
    {
        var request = new XMLHttpRequest();
    }
    catch(e1)
    {
        try
        {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e2)
        {
            try
            {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e3)
            {
                request = false;
            }
        }
    }
    return request;
}

$(window).load(function () {
    forNewDom('main','target', 'href');
});

