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

function ableOrDisableForm(classparam, idparam){
    if ($('#'+idparam).prop("checked")) {
        $('.' + classparam).removeAttr('disabled');
    } else {
        $('.' + classparam).attr('disabled', true);
    }
}

function forNewDom(param, targ, hr)
{
        $("a.menu")
            .removeAttr(targ)
            .removeAttr(hr);
        ajaxUrl=param.replace("pages/","");
        $.post("php/poster.php", {url: ajaxUrl}, function (data)
        {
            $('#for-new-dom').html(data)
        } );
        $('footer')
            .css('display', 'none')
            .css('display', 'block');
}

// Старая но рабочая на 100% функция (до 13/06/16) для оптарвики формы с файлами
function AjaxFormRequest(resultid,formid,url){
    var form = document.forms[formid];
    //var form = $('#'+formid).;
    var formData = new FormData(form);
    var xhr = new AjaxRequest();
    xhr.open("POST", url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if(xhr.status == 200) {
                data = xhr.responseText;
                if(data != null) {
                    $('#'+resultid).html(data);
                } else {
                    $('#'+resultid).html("Ошибка при отправке формы");
                }
            }
        }
    };
    xhr.send(formData);
}

function showCommetsAndCart(){
    AjaxFormRequest('resultForComment1', 'formForComment1', 'php/otziv/showComment.php?idTovar=1&Fl=1');
    AjaxFormRequest('resultForComment2', 'formForComment2', 'php/otziv/showComment.php?idTovar=2&Fl=1');
    AjaxFormRequest('resultForComment3', 'formForComment3', 'php/otziv/showComment.php?idTovar=3&Fl=1');
    AjaxFormRequest('resultForComment4', 'formForComment4', 'php/otziv/showComment.php?idTovar=4&Fl=1');
    AjaxFormRequest('result_for_cart', 'form_id', 'php/cart.php');
}

$(window).load(function () {
    forNewDom('pages/main.php','target', 'href');
    showCommetsAndCart();
});

// Что-то в процессе
// function AjaxFormRequest(resultid,formid,url){
//     var form = document.forms[formid];
//     //var form = $('#'+formid).;
//     var formData = new FormData(form);
//     var xhr = new AjaxRequest();
//     xhr.open("POST", url);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4) {
//             if(xhr.status == 200) {
//                 data = xhr.responseText;
//                 if(data != null) {
//                     $('#'+resultid).html(data);
//                 } else {
//                     $('#'+resultid).html("Ошибка при отправке формы");
//                 }
//             }
//         }
//     };
//     xhr.send(formData);
// }

// function forNewDom(param, targ, hr)
// {
//     $("a.menu").removeAttr(targ);
//     $("a.menu").removeAttr(hr);
//     url='url='+param.replace("pages/","");
//     request = new AjaxRequest();
//     request.open("POST", "php/poster.php", true);
//     request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//     request.setRequestHeader("Content-length", url.length);
//     request.setRequestHeader("Connection", "close");
//     request.onreadystatechange = function()
//     {
//         if (this.readyState == 4)
//         {
//             if (this.status == 200)
//             {
//                 if (this.responseText != null)
//                 {
//                     $('#for-new-dom').html(this.responseText);
//                     showCommets();
//                 }
//                 else alert("Ошибка AJAX: Данные не получены");
//             }
//             else alert( "Ошибка AJAX: " + this.statusText);
//         }
//     };
//     $('footer').css('display', 'none');
//     request.send(url);
//     $('footer').css('display', 'block');
// }



//Старая функция (до 04/06/16) для отправки формы (не отправляет файлы)
// function AjaxFormRequest(result_id,form_id,url) {
//     jQuery.ajax({
//         url:     url, //Адрес подгружаемой страницы
//         type:     "POST", //Тип запроса
//         dataType: "html", //Тип данных
//         data: jQuery("#"+form_id).serialize(),
//         success: function(response) { //Если все нормально
//             $('#'+result_id).html(response);
//         },
//         error: function(response) { //Если ошибка
//             $('#'+result_id).html("Ошибка при отправке формы");
//         }
//     });
// }