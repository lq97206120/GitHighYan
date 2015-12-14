<?php
return array(
//自己配置的变量需要用C('')函数调用出string 系统定义的可以直接用 
//系统定义的GROUP_NAME __PUBLIC__ __ROOT__ {:U()} $user['']都是引擎自动解析的 
//文件的路径需要全路径，action modules id文件是引擎解析的
    //const: __ROOT__=>/blog
//    		APP_NAME=>APP
//    		APP_PATH=>./APP/
//    		GROUP_NAME=>Admin
//          __GROUP__=>/blog/index.php/Admin
//  名称		    ThinkPHP     内部            HTML
//系统数组		$_POST     $_POST[]/I()    {$THink.post}
//系统数组		$_CONFIG   C('')          {$Think.config}
//const       GROUP_NAME GROUP_NAME     {$Think.const}
//自定变量        $user    $user assign()  {$user}      
//函数          U()          U()           {:U()}
//     
	'TMPL_PARSE_STRING'=>array(
	'__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/'.'Modules/'.GROUP_NAME.'/Tpl/Public',
    ),
    'URL_HTML_SUFFIX'=>'',

  

);