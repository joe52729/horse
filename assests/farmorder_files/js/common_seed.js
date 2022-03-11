$(function(){
    // toggle sidebar when button clicked
    $(".sidebar-toggle").click(function () {
        $('.seed-sidebar').toggleClass('toggled');
    });
    $('.all_read').on('click', function(e) {
        e.preventDefault();
        var _uid = $("#user_uid").text()
        $.post('./api/notifications/set_read_all', {
            'user_uid': _uid
        }, function(json) {
            if (json.sys_code == 200) {
                $('.notificationsMenu').find('li').removeClass('bg-efefef');
                $('.notificationsCount').remove();
            }
        }, 'json');
    });
    // auto-expand submenu if an item is active
    var active = $('.sidebar .active');
    
    if (active.length && active.parent('.collapse').length) {
        console.log("21")
    
        var parent = active.parent('.collapse');
    
        parent.prev('a').attr('aria-expanded', true);
        parent.addClass('show');
    }
    // // dataTables common setting
    $.extend( true, $.fn.dataTable.defaults, {
        responsive: true,
        "language": { "url": "./assets_panel/json/Chinese-traditional.json"},
    } );
    // $('.table').dataTable({
    //     responsive: true,
    //     "language": { "url": "./assets_panel/json/Chinese-traditional.json"},
    // })
}) 

$(window).load(function(){
    $(".page-loader-wrapper").hide();
});    

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)
        return unescape(r[2]);
    return null;
}