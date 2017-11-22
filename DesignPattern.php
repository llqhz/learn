/**
* 适配器模式:
* 自己对获取的api值进行trans
*/
class Weather
{

    function get()
    {
        //.....
        //.....
        //.....
        return ['name'=>'hubei','temperature'=>'23'];
    }
}


class UsWeather {
    public function get()
    {
        $weather = new Weather();
        $row = $weather->get();
        $row['temperature'] = $this->trans( $row['temperature']);
        return $row;
    }

    public function trans($temperature)
    {
        return $temperature*9/5+32;
    }
}


/**
 * 桥接模式:
 * 消息有:一般,警告,危险三个等级
 * 又有:站内信,email,短信三种方式
 * 发送 警告的email 一般的短信... 3*3=9中组合方式
 * 通过桥接模式,不继承,从两个维度分类,一个维度处理完了传递给下一个维度 3+3=6
 */

/**
*  基类
*/
abstract class Msg {
    public function send($name, $text){}
}

class Normal {
    public function send($name,$text)
    {
        return 'normal: '.$name.' => '.$text;
    }
}
class Warning {
    public function send($name,$text)
    {
        return 'warning: '.$name.' => '.$text;
    }
}
class Danger {
    public function send($name,$text)
    {
        return 'danger: '.$name.' => '.$text;
    }
}

class Zhan {
    public function send($msg)
    {
        return 'zhan: '.$msg;
    }
}
class Email {
    public function send($msg)
    {
        return 'email: '.$msg;
    }
}
class Sms {
    public function send($msg)
    {
        return 'sms: '.$msg;
    }
}

$name = 'llqhz'; $text = 'hello';
$msg = new Normal();
echo (new zhan())->send( (new Normal())->send($name,$text) );

echo "<hr>";

$danger = new Danger();
$sms = new Sms();
echo $sms->send( $danger->send($name,$text) );



/**
 * 装饰器模式: 给文章灵活的装饰 装饰函数的递归
 * 指定一个对象art用来装饰,构造装饰器类继承装饰器基类,
 * 装饰器构造时参数为art对象,art的获取内容不用getContent命名是为了
 * 在调用decorator的统一,
 *
 * 每个构造器参数为art对象/artdec的子对象,只要有->decorator方法即可
 * 调用过程类似递归:
 * new SeoArt(new AdArt($art))
 * 当调用其decorator方法时,先调用内层AdArt的decorator方法,再添加自己的东西;
 * 在调用内层AdArt->decorator方法时,先调用AdArt内层的art->decorator方法,再添加自己的东西;
 */
class Art {
    protected $content;

    public function __construct($content)
    {
        echo "调用了Art->construct<br>";
        $this->content = $content;
    }

    public function decorator()
    {
        echo "调用了Art->decorator<br>";
        return $this->content;
    }
}
class ArtDec extends Art {
    protected $art = null;

    public function __construct($art)
    {
        echo "调用了ArtDec->construct<br>";
        $this->art = $art;
    }

    public function decorator() {
        echo "调用了ArtDec->decorator<br>";
        return $this->art->decorator();
    }
}

class SeoArt extends ArtDec {
    public function decorator()
    {
        echo "调用了SeoArt->decorator<br>";
        return '<b>'.$this->art->decorator().'</b>';
    }
}
class AdArt extends ArtDec {
    public function decorator()
    {
        echo "调用了AdArt->decorator<br>";
        return '<i>'.$this->art->decorator().'</i>';
    }
}
class BetiArt extends ArtDec {
    public function decorator()
    {
        echo "调用了BetiArt->decorator<br>";
        return '<del>'.$this->art->decorator().'</del>';
    }
}


$art = new Art('这是一篇文章');
var_dump( $art->decorator() );

var_dump($art);
$art = new AdArt($art);
$art = new SeoArt($art);
echo " has newed AdArt <br>";
var_dump($art);
echo 'prepare to call $art->decorator() <hr>';
$str = $art->decorator();
echo '<hr> has called $art->decorator() <br>';
echo $str,'<br>';

var_dump( $art->decorator() );

/**
 * 策略模式 : 通过雇佣不同的厨师对象,来组合不同种类的对象
 * 饭店需加厨师属性,而方法改为调用厨师属性的方法,new 时需传递厨师对象以变成成员
 */
class NorthCooker {
    public function fan()
    {
        return '面条';
    }

    public function cai()
    {
        return '炒菜';
    }
    public function tang()
    {
        return '蛋花汤';
    }
}




class SouthCooker {
    public function fan()
    {
        return '米饭';
    }

    public function cai()
    {
        return '炒菜+糖';
    }
    public function tang()
    {
        return '蛋花汤';
    }
}




class FanDian {
    //存放厨师对象,分别专门用来调用fan/cai/tang方法
    protected $fanCooker = null;
    protected $caiCooker = null;
    protected $tangCooker = null;

    public function __construct($f, $c, $t)
    {
        $this->fanCooker = $f;
        $this->caiCooker = $c;
        $this->tangCooker = $t;
    }

    public function creatFan()
    {
        return $this->fanCooker->fan();
    }
    public function creatCai()
    {
        return $this->caiCooker->cai();
    }
    public function creatTang()
    {
        return $this->tangCooker->tang();
    }

}


$fandian = new FanDian(new NorthCooker(), new SouthCooker(), new NorthCooker());

echo $fandian->creatCai();

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>观察者模式</title>
    <style type="text/css">
        div {
            width: 80%;
            height: 150px;
            border: 1px solid green;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <select name="sel">
        <option value="0">男士风格</option>
        <option value="1">女士风格</option>
    </select>
    <button type="button" onclick="drop()">删除div3观察者</button>
    <div id="test1"></div>
    <div id="test2"></div>
    <div id="test3"></div>

</body>

<script>

    var sel = document.getElementsByName('sel')[0];
    sel.observes = [];

    //增加观察者
    sel.attach = function (obj) {
        this.observes[this.observes.length] = obj;
    }

    //删除观察者
    sel.detach = function (obj) {
        for (var i=0; i< this.length; i++) {
            if ( this.observes[i] === obj ) {
                delete this.observes[i];
            }
        }
    }

    //通知观察者
    sel.notify = function () {
        for (var i=0; i<this.observes.length; i++) {
            this.observes[i].update(this);
        }
    }

    //绑定事件
    sel.onchange = sel.notify;

    var div2 = document.getElementById('test2');
    var div3 = document.getElementById('test3');

    sel.attach(div2);
    sel.attach(div3);

    function drop(){
        sel.detach(div3);
    }

    div2.update = function (sel) {
        if (sel.value == 0) {
            this.innerHTML = '男士足球新闻';
        } else if (sel.value == 1) {
            this.innerHTML = '女士明星新闻';
        }
    }

    div3.update = function (sel) {
        if (sel.value == 0) {
            this.innerHTML = '男士机械键盘广告';
        } else if (sel.value == 1) {
            this.innerHTML = '女士衣服广告';
        }
    }
</script>


/**
 * 责任链模式  : 需要一个上级top即可
 * 论坛 : 举报
 * 粗口   黄赌毒   反政府
 * 版主->  警察 ->  国安
 */


class Admin {

    //权限统一管理
    public function proc($danger)
    {
        //如果本管理员可以处理
        if ($this->power >= $danger) {
            $this->doProc();
        } else {
            //解决尾问题 最后一个管理员没有上级
            if ( $this->top != null) {
                //找上级处理  php动态变量名[$this->top]
                $this->top = new $this->top();
                $this->top->proc($danger);
            } else {
                //没有上级了,自己处理
                $this->doProc($danger);
            }
        }
    }
}


class Banzhu extends Admin {
    protected $power = 1;
    protected $top = 'Police';
    public function doProc()
    {
        echo "删帖";
    }
}

class Police extends Admin {
    protected $power = 2;
    protected $top = 'Guoan';
    public function doProc()
    {
        echo '抓人';
    }
}

class Guoan extends Admin {
    protected $power = 3;
    protected $top = null;
    public function doProc()
    {
        echo "灭口";
    }
}



$danger = 2;
$admin = new Banzhu();
$admin->proc($danger);
















