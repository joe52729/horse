$(function(){
    var lang = getUrlParam("lang");
    console.log(lang)
    var menu = '';
    var menuHtml = '';
    var langText = '';
    var allContent = '';
    switch(lang){
        case null :
            lang = 'en';
            menu = en.menu;
            langText = 'EN'
            allContent = en;
        break;
        case "en" :
            menu = en.menu;
            langText = 'EN'
            allContent = en;
        break;
        case "zh" :
            menu = zh.menu;
            langText = '繁';
            allContent = zh;
        break;
        case "cn" :
            menu = cn.menu;
            langText = '简';
            allContent = cn;
        break;
    }
    
    for(var i=0; i < menu.length ; i++ ){
        menuHtml += '<li class="nav-item" data-menuanchor="' + menu[i] + '">';
            menuHtml += '<a class="nav-link" href="#' + menu[i] + '" >' + allContent.menu_word[i] + '</a>';
        menuHtml += '</li>';
    }
    var langHtml = '<li class="nav-item dropdown "><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' + langText + '</a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink"><a class="dropdown-item" href="http://uatpanel.agritrustworthy.com/ai/?lang=cn">简</a><a class="dropdown-item" href="http://uatpanel.agritrustworthy.com/ai/?lang=zh">繁</a><a class="dropdown-item" href="http://uatpanel.agritrustworthy.com/ai/?lang=en">EN</a></div></li>';
    $("#navbarNav").find("ul").html(menuHtml+langHtml);

    // S1放文字
    var $s1 = $("#s1");
    var $s1content = $("#s1").find(".container");

    $s1content.each(function(index){
        var $this = $(this);
        console.log(index)
        console.log(allContent.sec1.section[index])
        $this.find("h2").html(allContent.sec1.section[index]['title']);
        $this.find(".h1des").html(allContent.sec1.section[index]['des']);
    })
    // s1-slide1放圖
    $s1.find("#s1-content-img").attr("src",'../assets_panel/ai/images/' + lang + '/s1-1-1.png')
    $s1.find("#s1-content-img-m").attr("src",'../assets_panel/ai/images/' + lang + '/s1-1-2.png')
    // s1-slide2放圖
    $s1.find("#s1-s2-content-img").attr("src",'../assets_panel/ai/images/' + lang + '/s1-2-1.png')
    $s1.find("#s1-s2-content-img-m").attr("src",'../assets_panel/ai/images/' + lang + '/s1-2-2.png')
    // s1-slide3放圖
    $s1.find("#s1-s3-content-img").attr("src",'../assets_panel/ai/images/' + lang + '/s1-3-1.png')
    $s1.find("#s1-s3-content-img-m").attr("src",'../assets_panel/ai/images/' + lang + '/s1-3-2.png')

    // s2放文字
    var $s2content = $("#s2").find(".container-fluid");
    var $s2header = $(".s2header");
    var $s2intro = $(".s2-intro");

    $s2content.each(function(index){
        var $this = $(this);
        $this.find("h2").html(allContent.sec2[index]['title']);
        $this.find(".h2des").html(allContent.sec2[index]['des']);

        $this.find(".s2-intro").each(function(i){
            $(this).find(".s2-i-title").html(allContent.sec2[index].item[i]['title'])
            $(this).find(".s2-i-des").html(allContent.sec2[index].item[i]['des'])
        })
    })
    $(".s2-1-img").attr("src",'../assets_panel/ai/images/' + lang + '/s2-1.png')


    // s3放文字
    var $s3 = $("#s3");
    $s3.find("h2").html(allContent.sec3['title'])
    $s3.find(".s3-item").each(function(index){
        $(this).find(".s3-item-des").html(allContent.sec3.content[index]['des'])
    })

    // s4放文字
    var $s4 = $("#s4");
    $s4.find(".slide").each(function(index){
        // pc
        var _s4Html = '';
        _s4Html += '<div class ="s4-info">';
            _s4Html += '<h2>' + allContent.sec4.content[index].title + '</h2>' ;
            _s4Html += '<p class="h2des">' + allContent.sec4.content[index].des + '</p>' ;
        _s4Html += '</div>';
        $(this).find(".s4-insert").html(_s4Html)
        // pc slide背景圖
        $(this).find(".slideWrapper").css({"background-image":'url(../assets_panel/ai/images/' + lang + '/tv1_bg' + (index+1) + '.jpg)'});

        // m
        var _s4mHtml = '';
        _s4mHtml += '<div class="slides4m100" id="s4mslide' + index + '" style="background-image:url(' + allContent.sec4.content[index].m_bg + ')">';
            _s4mHtml += '<div class ="s4-info">';
                _s4mHtml += '<h2>' + allContent.sec4.content[index].title + '</h2>' ;
                _s4mHtml += '<p class="h2des">' + allContent.sec4.content[index].des + '</p>' ;
            _s4mHtml += '</div>';
            _s4mHtml += '<img class="s4_content_img img-fluid" src="' + allContent.sec4.content[index].m_img + '">'
        _s4mHtml += '</div>'
        $(this).find(".slideWrapperM").html(_s4mHtml)
    })

    
    // partners 放文字
    var $secPartner = $("#secPartner");
    $secPartner.find("h2").text(allContent.secPartner.title)
    var _secPHtml = '';
    $.each(allContent.secPartner.partners,function(k4,v4){
        _secPHtml += '<div class="col-4 col-md-2 text-center mb-5">'
            _secPHtml += '<a href="' + v4.href + '">'
                _secPHtml += '<img class="img-fluid" alt="' + v4.title + '" src="' + v4.img + '">'
            _secPHtml += '</a>'
        _secPHtml += '</div>'
    })
    $secPartner.find(".row").html(_secPHtml)
    
    // s5放文字
    var $s5 = $("#s5");
    $s5.find(".sec5-title").each(function(index){
        $(this).html(allContent.secPartner.content[index]['title'])
    })
    $s5.find("h2").text(allContent.sec5.title)
    var _s5_content = allContent.sec5.content;
    var _s5Html = ''
    $.each(_s5_content,function(k,v){
        // console.log(v)
        // _s5Html += '<div class="col-12 col-md-4">' ;
        //     _s5Html += '<div class="row s5_inside_row mt-3 mb-3">' ;
        //         _s5Html += '<div class="col-4 text-center">';
        //             _s5Html += '<img class="img-fluid" src="' + v.img + '">';
        //         _s5Html += '</div>'
        //         _s5Html += '<div class="col-8">';
        //             _s5Html += '<h2 class="h2-col-title">' + v.title + '</h2>';
        //             _s5Html += '<p class="h2_des">' + v.des + '</p>';
        //             _s5Html += '<ul class="s5-ul">';
        //                 for( var i=0 ; i < v.items.length ; i++ ){
        //                     _s5Html += '<li>' + v.items[i] + '</li>'
        //                 }
        //             _s5Html += '</ul>';
        //         _s5Html += '</div>'
        //     _s5Html += '</div>'
        // _s5Html += '</div>'
        _s5Html += '<div class="col-12 col-md-4 mb-3 pt-3 service-style">' ;
            _s5Html += '<img class="img-fluid s5img" src="' + v.img + '">';
            _s5Html += '<h2 class="h2-col-title">' + v.title + '</h2>';
            _s5Html += '<p class="h2_des pt-3 mt-2">' + v.des + '</p>';
            _s5Html += '<ul class="s5-ul">';
                for( var i=0 ; i < v.items.length ; i++ ){
                    _s5Html += '<li>' + v.items[i] + '</li>'
                }
            _s5Html += '</ul>';
            // _s5Html += '<div class="row s5_inside_row mt-3 mb-3">' ;
            //     _s5Html += '<div class="col-4 text-center">';
            //         _s5Html += '<img class="img-fluid" src="' + v.img + '">';
            //     _s5Html += '</div>'
            //     _s5Html += '<div class="col-8">';
            //         _s5Html += '<h2 class="h2-col-title">' + v.title + '</h2>';
            //         _s5Html += '<p class="h2_des">' + v.des + '</p>';
            //         _s5Html += '<ul class="s5-ul">';
            //             for( var i=0 ; i < v.items.length ; i++ ){
            //                 _s5Html += '<li>' + v.items[i] + '</li>'
            //             }
            //         _s5Html += '</ul>';
            //     _s5Html += '</div>'
            // _s5Html += '</div>'
        _s5Html += '</div>'

    })
    $("#s5-items-row").html(_s5Html)
    // s6放文字
    var $s6 = $("#s6");
    $s6.find("h2").text(allContent.sec6.title);
    $s6.find(".s6-content").html(allContent.sec6.content);
    $(".s6-img-src").attr("src",'../assets_panel/ai/images/' + lang + '/s6-1.png')

    // s7放文字
    var $s7 = $("#s7");
    $s7.find("h2").each(function(index){
        $(this).text(allContent.sec7[index].title);
    })
    $s7.find(".msg_input").each(function(index){
        if( index == 4 ){
            // console.log(allContent.sec7[0].input)
            $(this).attr("value",allContent.sec7[0].input[index]);
        }else{
            $(this).attr("placeholder",allContent.sec7[0].input[index]);
        }
    })
    $(".col-content-item").each(function(index){
        $(this).text( allContent.sec7[1]['content'][index].title + " " + allContent.sec7[1]['content'][index].des)
    })

    // 版權放文字
    $(".copyright").html(allContent.copyright)
    $('#fullpage').fullpage({
        sectionsColor: ['#f2f2f2', 'white', '#fafafa', '#fafafa', 'whitesmoke', 'white' ,'#fafafa'],
        // autoScrolling: false,
        menu: '#menu',
        verticalCentered: false,
        slidesNavigation: true,
        controlArrows: false,
        scrollOverflow: true,
        anchors: allContent.menu ,
        normalScrollElements: '.s6-content-height',
        // scrollBar: true,
        afterRender: function(){
            $(".loadingHere").css({"display":"none"})
        },
        afterLoad: function(anchorLink, index){
            var _width = $(window).width();
            if( index == 1 && _width > 480 ){
                // pc版第一屏使用透明
                $(".nav_ai").attr("id","")
            }else{
                $(".nav_ai").attr("id","nav_ai_black")
            }
        },
    });
})

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)
        return unescape(r[2]);
    return null;
}