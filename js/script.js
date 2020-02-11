$(document).ready(function(){
    $("#tambah").on('click',function(){
        if($("#add").val() == 0){
            alert("Please input your activity");
        } else {
            $.post("ajax/activity.php",
            {
                actv: $("#add").val(),
                usr: $("strong").text()
            },
            function(data, status){
                $(".container-act-list").html(data);
            });
        }
    });

    // edit untuk halaman index karena
    // direktory ajak nya beda dengan edit di halaman search
    $(".container-act-list").on('click', '#edit_at_index' ,function(event){
        event.preventDefault();
        let usr = $("strong").text();
        let id = $(this).next().attr("href").substring(17);
        let oldActv = $(this).parent().prev().text();
        let newActv = prompt("Please edit your activity", oldActv);

        if(newActv != null){
            $.post("ajax/editActv.php",
            {
                actv: newActv ,
                idEditActv: id,
                user: usr
            },
            function(data, status){
                $(".container-act-list").html(data);
            });
        } else{
            alert("please input new actv");
        }
        
    });

    // edit untuk halaman search
    $(".container-act-list").on('click', '#edit_at_search' ,function(event){
        event.preventDefault();
        let usr = $("strong").text();
        let id = $(this).next().attr("href").substring(13);
        let key = $("span.badge-success").text();
        let oldActv = $(this).parent().prev().text();
        let newActv = prompt("Please edit your activity", oldActv);

        if(newActv != null){
            $.post("../ajax/editActvAtSearchPage.php",
            {
                actv: newActv ,
                idEditActv: id,
                user: usr,
                keyword: key
            },
            function(data, status){
                $(".container-act-list").html(data);
            });
        } else{
            alert("please input new actv");
        }
        
    });

    

    

});