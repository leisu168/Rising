$(document).ready(function(){

    /*首页图片*/
    $(".alpha_div").mouseover(function(){
        $(this).css("opacity","0.80");   
        $title_1 = $(this).next().attr("alt");  
        $single_title = ('<span id="title_h">'+$title_1+'</span>');
        $(this).append($single_title);
        $sign = ('<i class="fa fa-refresh fa-spin fa-3x fa-inverse"></i>');
        $(this).append($sign);
        });
    $(".alpha_div").mouseout(function(){ 
        $(this).css("opacity","0.001");
         $("#title_h").empty();
         $(".index-post-photo i").empty();
    });

    /*返回顶部*/
    $(window).scroll(function() {
        var goto_top = $(window).scrollTop();
        if (goto_top > 168) {
        //滚动条的位置和顶部距离大于168px时显示
           $("#float_up").css("display","block");
        }
        else {
            $("#float_up").css("display","none");
        }
    });

    /*说说日期*/
    $(".shuoshuo_li").mouseover(function(){
        $(this).children().first().css({"background-color":"#fff","box-shadow":"0 0 15px #3c78d8"});   
    }); 
    $(".shuoshuo_li").mouseout(function(){ 
        $(this).children().first().css({"background-color":"","box-shadow":"0 0 0px #3c78d8"});
         
    });

	/*搜搜框*/
    $("#search_logo").click(function(){
        if($("#searchform").is(":hidden")){ 
        /*$("#searchform").css("display","none")*/ 
            $("#searchform").show();
            $(".index-posts").css("margin-top","35px");
        }else{
            $("#searchform").hide();
            $(".index-posts").css("margin-top","0px");
        }
    });
    


});

