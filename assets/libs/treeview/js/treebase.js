function chkrow(idx){

    var flag = "";
    for (var i = 0; i < $("input:checkbox[data-index = "+ idx +"]").length; i++) {
        if($("input:checkbox[data-index = "+ idx +"]")[0].checked == true){
            flag = false;
        }else{
            flag = true;
        }
        i = 1000;
    }

    for (var i = 0; i < $("input:checkbox[data-index = "+ idx +"]").length; i++) {
        if(!($("input:checkbox[data-index = "+ idx +"]")[i].disabled)){
            $("input:checkbox[data-index = "+ idx +"]")[i].checked = flag;
        }
    }

    // $("input:checkbox[data-index = "+ idx +"]").prop('checked', flag);
    
}

function readToggle(idx, a){

    if(!(a.checked)){
        $("input:checkbox[data-index = "+ idx +"]").prop('checked', a.checked);
    }
    
}

function otherToggle(idx, a){

    if(a.checked){
        $("input:checkbox[data-index = "+ idx +"]")[0].checked = a.checked;
    }
    
}

$(document).ready(function(){
    $("#checkallCB").click(function(){
        var flag = "";
        for (var i = 0; i < $("input[type=checkbox]").length; i++) {
            if($("input[type=checkbox]")[0].checked == true){
                flag = false;
            }else{
                flag = true;
            }
            i = 1000;
        }

        for (var i = 0; i < $("input:checkbox").length; i++) {
            if(!($("input:checkbox")[i].disabled)){
                $("input:checkbox")[i].checked = flag;
            }
        }

        // $("input[type=checkbox]").prop('checked', flag);
    });
})