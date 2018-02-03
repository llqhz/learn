/P js 笔记 P/
js字符串截取：
    substring：从第几位截取到第几位
    substr：从第几位截取几位
js 字符串查找：
    str.indexOf('hel')
js添加节点
    appendChild() 为当前节点添加一个新的子节点,放在最后的子节点后
    eg:parent.appendChild(newChild);
    insertBefore()  为当前节点添加一个新的子节点,放在指定的子节点后
    eg:
    parent.insertBefore(newChild,child2);
jQuery添加节点:
    http://www.cnblogs.com/rentianyuan/p/4767113.html
    第一组：before()、insertBefore()

    第二组：after()、insertAfter()

    第三组：prepend()、prependTo()

    第四组：append()、appendTo()

js创建对象：
   (1)  var obj = new Object();
        obj.prototype = {
            name : 'JavaScript',
            fun : function() {
                //do something;
                console.log("this in something in obj.fun");
            }
        }
   (2)  var obj = {
            name : "obj.name",
            fun : function(){
                console.log("this in something in obj.fun");
            }
        }


检测变量是否为undefind：
typeof(eventImg.src) == "undefined"

event.target 触发js 获取事件的子元素
让所有子元素回原，再让target改变




ajax: (核心三步)
1: xhr = XMLHttpRequest();
2: xhr.open('get/post',url,true/false);
3: xhr.send(null);




/*jquery学习笔记*/


jquery引入:
./jquery.js 便于维护升级而不是jquery1.7.2.js


jquery选择器:
$('p')  选择所有的p
$('$id') id选择器
$('.class') 类选择器
$('*') 通配选择器

$('div p')   层次选择器
$('input + span')  同级单弟选择器
$('input ~ span')  同级多弟选择器(可以不接连) 只要同级,都会被选中

属性选择器:
$('input[type=password]')   属性
$('input:password')         简化属性
$('input[name^=stu]')       以stu开头
$('input[name$=stu]')       以stu结尾
$('input[name*=stu]')       包含stu



过滤器:
节点顺序过滤器:
$('li:first')
$('li:last')
$('li:odd')     奇数
$('li:even')    偶数
$('li:eq(3)')   第四个

内容过滤器:
$('li:contains(家)')     li及其子节点中文字节点有家的
$('li:empty')           纯空li标签
$('li:parent')          与empty对立,表具有父元素资格
$('li:has(span)')       子元素是span或其多层级后代中拥有span的li

表单类型过滤器:
$('input:text') => $('input[type=text]')

元素可见性过滤器:
$('div:hidden')         选中所有当前最终css为hidden的过滤器

子元素选择器:  =>  css3的选择器
$('li:last-of-type')    同类型的最后一个节点
$('li:last-child')      li必须作为最后一个子节点才会有效

<div class="parent">
  <h1>Child</h1>   <!-- h1:first-child, h1:first-of-type .parent > :first-of-type -->
  <div>Child</div> <!-- div:nth-child(2), div:first-of-type .parent > :first-of-type -->
  <div>Child</div>
  <div>Child</div>
</div>


操作属性:
操作节点普通属性:
$('img').attr('src');               读[js数组]
$('img').attr('src', 'on.jpg');     写

操作节点css属性:
$('li').css('background')             读
$('li').css('background','red')       写

操作节点布尔属性:
$('input:checkbox').prop('checked', true);
$('input:checkbox').prop('checked', false);


删除节点:
$('ul').remove();           删除
$('ul').empty();            清空

增加节点:   [内后]append appendTo 内前prepend prependTo [外前]after [外后]before
$('ul').append( $('<li>li节点</li>') );       //向所有ul中添加li节点
$('<li>新的li</li>').appendTo( $('ul'));      //向所有ul中添加li节点
$('ul').prepend( $('<li>li节点</li>') );      //向所有ul内前方添加li节点
$('<li>li节点</li>').prependTo( $('ul') );    //向所有ul内前方中添加li节点

$('ul').append('<p>这里是新的p</p>')

包裹节点:
外包:
$('input:text').wrap('<p></p>');            每个p包裹每个input
$('input:text').wrapAll('<div class="extra-wrapper"></div>')    一个大div包裹所有的input
内包:
$('li').wrapInner('<b></b>');            每个li内包裹每个b


jQuery对象与DOM对象的的转化:
jQuery转DOM:
    $('li')[2]          第三个li Element
    $(Element)          将Elenment转化为jQuery对象

jQuery对象的遍历:
    $('li').each(function(index, el) {
        //this   此处this指当前遍历的DOM对象
        $(this).css('background', 'blue');
        this.checked = !this.checked;       反选的代码
    });


jQuery改值:
    $('li').html('<span>span</span>')
    $('input').val('xiaoguai');


jQuery事件绑定
  1:语法特点,去掉on 函数作为参数
    input.onmouseover = function() { this....  }
    $('input').mouseover(function(event) {  $(this)....      });
    触发:
    input.click();  /  $(input).click();

  2:绑定次数
    input.click();只能绑定一次,后者覆盖前者
    $(input).click();可以绑定多次,从前到后依次执行


jQuery $作用:
    1:$('p')  2:$('<p></p>') 3:$(p)  4:$(function(){ load })

jQuery ready
    js window.onload = function (){ src加载完  }
    jQuery ready:  $(document).ready(function() {});

jQuery 事件bind  与 unbind
    $('p').bind('click', function(event) {});
    $('p').bind('click', chg);   函数名作为变量(函数式)  function chg() { .... }

    $('p').unbind('click', chg);

    $('p').one('click', function(event) { ... });       一次事件(只监听一次)

jQuery 事件委托
        原理: li->event.target=='li'
    $('ul').on('click','li',fun);       (ul->event.target=li) => fun
    $('ul').off('click','li',fun);      delete eventListener

jQuery 事件对象
    $(document).keydown(function(event) { event.which == 37 -> 40 });

jQuery 动画: hide slideUp fade  => animate({param1: value1}, speed)
    $('div').hide(2000, function() {  /*结束回调 */   });
    $('div').show(2000, function() {  /*结束回调 */   });
    $('div').slideUp(2000, function() {  /*结束回调 */   });
    $('div').slideDown(2000, function() {  /*结束回调 */   });
    $('div').slideUp(1000).delay(2000).show(2000);

    $('div').animate({'marginLeft': '100px'}, 2000);

jQuery ajax GET
    $.get('url', function(data) {  /*...*/  });

jQuery ajax POST
    $.post('url', {param1: 'value1'}, function(data, textStatus, xhr) { ... });
'images/004.gif'
jQuery ajax
    $.ajax({
        url: '/path/to/file',
        type: 'default GET (Other values: POST)',
        dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {param1: 'value1'},
        success: function(){

        }
    });

jquery ajax formdata
    var fm = new FormData(form);
    var file = $('input:file')[0].files[0];
    fm.append('pic', file);
    $.ajax({
        url: '01.php',
        type: 'POST',
        //通过formdata创建的对象需要这两句
        processData: false, //formdata 已经对值进行了编码处理
        contentType: false, //formdata 且已经声明了multipart
        data: fm,       //这里data直接填FormData对象上传
        success: function (res) {
            console.log(res);
        }
    });


js 三元运算符:
''  0  0.0 =>  fasle
[] {} '0' =>　true                                                                      

需要注意     undefined  false  0  '' 'nothing'  []/{}/function                                                                 
parm = parm ? parm : parmk  适合用来判断 
parm = parm || parmk                                                                       
parm = parm && parmk
parm = (typeof parm == 'undefined') ? parm : parmk                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       
                                                                       





