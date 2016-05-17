/**
 * Created by Михаил on 12.05.2016.
 */
$('li').click(function(){
    var id=this.id;
    if (id==='index'){
        $('#for-new-dom').empty();
        $('main').css('display', 'block');}
    else {
        $('main').css('display', 'none');
        var link = document.querySelector('link.'+id);
        var content = link.import.querySelector('p#'+id);
        $('#for-new-dom').empty();
        $('#for-new-dom').append(content);
    }});