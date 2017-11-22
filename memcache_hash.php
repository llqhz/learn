<?php
/**
 * hasher: memcache一致性哈希hash算法
 * 作用: 用于根据寻找服务器存取
 * 优势: 实现平均化,可平衡服务器宕机的压力
 */
class hasher
{
    protected $nodes = array();      //服务器节点集合
    protected $points = array();     //虚拟节点集合
    protected $_mul = 64;            //虚拟节点乘数

    /**
     * 根据key单向加密算出唯一int自然数
     * @param  string $value 存取的key
     * @return int           返回的int值
     */
    public function _hash($key)
    {
        return sprintf('%u',crc32($key));
    }

    /**
     * 添加服务器节点,并自动虚拟节点
     * @param string $node 节点标识名
     */
    public function addNode($node)
    {
        //增加服务器
        $this->nodes[$node] = [];

        //hash出虚拟节点编号
        //添加双向指针: node[]=id => points[id]=node
        // node[a][0]=213  node[a][1]=324     node[a][2]=312
        // points[123]=a  points[324]=a     points[312]=a
        for ($i=0; $i < $this->_mul; $i++) {
            $point = $node.'_hash_'.$i;
            $id = $this->_hash($point);  //转换为编号

            //双向指针:
            $this->points[$id] = $node;
            $this->nodes[$node][$i] = $id;
        }

        //将虚拟节点排序 ksort:按键名排序
        ksort($this->points);

    }

    /**
     * 一次添加多个节点
     * @param array $nodes 节点数组
     */
    public function addNodes($nodes)
    {
        foreach ($nodes as $node) {
            $this->addNode($node);
        }
    }

    /**
     * 删除服务器节点及其所有虚拟节点
     * @param  string $node 节点标识名
     */
    public function delNode($node)
    {
        //删除服务器的每个虚拟子节点
        foreach ($this->nodes[$node] as $id) {
            unset($this->points[$id]);
        }

        //删除服务器节点
        unset($this->nodes[$node]);
    }


    /**
     * 根据key来算出在存取服务器的位置
     * @param  string $key 需要存取的key
     * @return string      目标服务器
     */
    public function lookup($key)
    {
        //转换为数字并向上取整,值即为服务器
        $position = $this->_hash($key);

        foreach ($this->points as $id => $node) {
            if ( $id >= $position) {
                //找到后重置数组指针便于下一次遍历
                reset($this->points);
                return $this->points[$id];
            }
        }

        //重置指针的同时返回第一个元素的值
        return reset($this->points);
    }

}


/*一致性哈希算法 example*/
$hash = new hasher();

$server = array();
$server['A'] = array( 'host' => 'localhost', 'port' => 11211 );
$server['B'] = array( 'host' => 'localhost', 'port' => 11212 );
$server['C'] = array( 'host' => 'localhost', 'port' => 11213 );
$server['D'] = array( 'host' => 'localhost', 'port' => 11214 );
$server['E'] = array( 'host' => 'localhost', 'port' => 11215 );

$hash->addNodes( array_keys($server) );
//print_r($hash);

public function memsave($n)
{
    $mem = new Memcache();
    for ($i=0; $i < 100; $i++) {
        $key = 'key_'.$i;
        $val = 'val_'.$i;

        $ser = $hash->lookup($key);
        $mem->connect($server[$ser]['host'],$server[$ser]['port']);

        //一次性存
        $mem->set($key,$val,false,0);

        echo $key." saved in ".$ser.'<br>';
    }
}


echo "<hr>";
public function memget($n)
{
    $mem = new Memcache();

    //可多次读取
    for ($i=0; $i < $n; $i++) {
        $key = 'key_'.$i;
        $ser = $hash->lookup($key);
        $mem->connect($server[$ser]['host'],$server[$ser]['port']);

        $val = $mem->get($key);
        if ( !$val) {
            $val = 'val'.strstr($key,'_');
            $mem->add($key,$val,false,0);
            echo '------'.$key.' => '.$val." save to ".$ser.' <br>';
        } else {
            echo '&nbsp;&nbsp;&nbsp;'.$key.' => '.$val." get from ".$ser.' <br>';
        }
    }
}



/*测试函数*/
$n = 10;
memsave($n);
//memget($n);


