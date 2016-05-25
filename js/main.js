/**
 * Created by Михаил on 24.05.2016.
 */
$(document).ready(forNewDom('main'));



function forNewDom(param)
{
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
            document.getElementById(result_id).innerHTML = response;
        },
        error: function(response) { //Если ошибка
            document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
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

