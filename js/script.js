$(document).ready(function(){
    $("#tambah").on('click',function(){
        if($("#add").val() == 0){
            alert("Please input your activity");
        } else {
            $.post("ajax/activity.php",
            {
                actv: $("#add").val()
            },
            function(data, status){
                $(".container-act-list").html(data);
            });
        }
    });

    

});