<?php
// .-----------------------------------------------------------------------------------
// | WE TRY THE BEST WAY
// |-----------------------------------------------------------------------------------
// | Author: 贝贝 <hebiduhebi@163.com>
// | Copyright (c) 2013-2015, http://www.gooraye.net. All Rights Reserved.
// |-----------------------------------------------------------------------------------


// 必须定义
define('UC_AUTH_KEY', '*lid9!,Nxnf":UrSq&FXm.zY;/wBo=D%e`4v26ZA'); //加密KEY
define('UC_APP_ID', 1); //应用ID
define('UC_API_TYPE', 'Model'); //可选值 Model / Service
define('UC_DB_DSN', 'mysql://boye105:1@192.168.0.100:3306/boye_2015_05_26_14_29_19'); // 数据库连接，使用Model方式调用API必须配置此项
define('UC_TABLE_PREFIX', 'itboye_'); // 数据表前缀，使用Model方式调用API必须配置此项