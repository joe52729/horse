<?php 
    //api
    // //api_url user_center
    // $config['api_url']['zh-TW']['user_center'] = "http://user.agritw.com/";
    // $config['api_url']['zh-CN']['user_center'] = "http://user.agritw.com/";

    $config['api_url']['zh-TW']['user_center'] = "http://localhost/tms/index/login";
    $config['api_url']['zh-CN']['user_center'] = "http://localhost/tms/index/login";

    //api_key
    $config['api_key']['zh-TW']['tp_id'] = "tms_fo";
    $config['api_key']['zh-TW']['tp_pw'] = "tms_fo0430";
    $config['api_key']['zh-CN']['tp_id'] = "tms_fo";
    $config['api_key']['zh-CN']['tp_pw'] = "tms_fo0430";

    //status
    $config['status']['zh-TW'][1] = "啟用";
    $config['status']['zh-TW'][0] = "關閉";
    $config['status']['zh-CN'][1] = "启用";
    $config['status']['zh-CN'][0] = "关闭";
    $config['status']['zh-TW']['dist'] = "通路商";
    $config['status']['zh-TW']['farm'] = "農場";
    $config['status']['zh-TW']['admin'] = "admin";
    $config['status']['zh-CN']['dist'] = "通路商";
    $config['status']['zh-CN']['farm'] = "农场";
    $config['status']['zh-CN']['admin'] = "admin";

    //type
    $config['type']['zh-TW']['dist'] = "通路商";
    $config['type']['zh-TW']['farm'] = "農場";
    $config['type']['zh-TW']['admin'] = "admin";
    $config['type']['zh-TW']['unreviewed'] = "未審核";
    $config['type']['zh-CN']['dist'] = "通路商";
    $config['type']['zh-CN']['farm'] = "农场";
    $config['type']['zh-CN']['admin'] = "admin";
    $config['type']['zh-CN']['unreviewed'] = "未审核";

    //order_status
    // 審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)、已下架(4)
    $config['order_status']['zh-TW'][0] = "審核中";
    $config['order_status']['zh-TW'][1] = "上架中";
    $config['order_status']['zh-TW'][2] = "已得標";
    $config['order_status']['zh-TW'][3] = "通路商取消交易";
    $config['order_status']['zh-TW'][4] = "已下架";
    $config['order_status']['zh-TW'][5] = "退回";
    $config['order_status']['zh-TW'][6] = "農場取消交易";//farm ,admin不重新審核
    $config['order_status']['zh-TW'][7] = "下標中";
    $config['order_status']['zh-CN'][0] = "审核中";
    $config['order_status']['zh-CN'][1] = "上架中";
    $config['order_status']['zh-CN'][2] = "已得标";
    $config['order_status']['zh-CN'][3] = "通路商取消交易";
    $config['order_status']['zh-CN'][4] = "已下架";
    $config['order_status']['zh-CN'][5] = "退回";
    $config['order_status']['zh-CN'][6] = "农场取消交易";//farm ,admin不重新審核
    $config['order_status']['zh-CN'][7] = "下标中";//farm ,admin不重新審核
    
    //check_level
    $config['check_level']['zh-TW']['organic'] = "有機";
    $config['check_level']['zh-TW']['no_medicine'] = "無藥";
    $config['check_level']['zh-TW']['safe'] = "安全";
    $config['check_level']['zh-CN']['organic'] = "有机";
    $config['check_level']['zh-CN']['no_medicine'] = "无药";
    $config['check_level']['zh-CN']['safe'] = "安全";

?>