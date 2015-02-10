$(function(){
    $('table.table').on('click', '.doAction', function(){
        var result = $(this).parents('.input-group').find('.doneAction').val();
        var flag = false;
        if(result.match(/\/delete\/[0-9]+/)){
            flag = window.confirm('realy?');
            if(flag){
                doPost(result);
            }
        }else{
            location.href = result;
        }
    });

    var doPost = function(action, $form, name){
        $form = $form || $('<form/>');
        name = name || 'send';
        var $submitType = $('<input/>').attr({
            'name': name,
            'type': 'hidden',
            'value': 1
        });
        $form.append($submitType);
        $form.attr({
            'action': action,
            'method': 'post'
        });
        $form.submit();
        return false;
    };
});
