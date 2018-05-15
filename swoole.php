<?php
/**
 * @Author: Marte
 * @Date:   2018-05-15 08:51:22
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-15 09:39:14
 */

// http server like apache or nginx
// 监听主机和端口
$http = new swoole_http_server('w.llqhz.cn',9501);

// 监听开始动作
$http->on('start',function ($server){
    echo 'swoole has been started and learn to port at w.llqhz.cn:9501';
});

// 监听请求并响应
$http->on('requset',function($request,$response){
    $response->header('Content-type','text/plain');
    $response->end('Hello World, this request is processed by swoole');
});

$http->start();

///////////////////////
// web socket server //
///////////////////////


// 1 创建监听
$server = new swoole_websocket_server('w.llqhz.cn',9502);

$server->on('open',function($server,$req){
    echo 'socket connection opened: '.$req->fd."\n";
});

$server->on('message',function($server,$frame){
    echo "received message from " , $frame->data , "n";

    // 处理请求
    $server->push($frame->fd,json_encode(['hello','world']));
});

$server->on('close',function($server,$fd){
    echo 'connection has been closed';
});
$server->start();




///////////////
//TCP Server //
///////////////

$server = new swoole_server();






