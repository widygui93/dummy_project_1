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

    $(".container-act-list").on('click', '.badge-primary' ,function(event){
        event.preventDefault();
        let id = $(this).next().attr("href").substring(17);
        let oldActv = $(this).parent().prev().text();
        let newActv = prompt("Please edit your activity", oldActv);

        if(newActv != null){
            $.post("ajax/editActv.php",
            {
                actv: newActv ,
                idEditActv: id
            },
            function(data, status){
                $(".container-act-list").html(data);
            });
        } else{
            alert("please input new actv");
        }
        
    });

    $("#search").keyup(function(){
        $(".container-act-list").load("ajax/searchActv.php?q=" + $("#search").val() );
    });

    

});