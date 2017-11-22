<?php
/**
 * @Author: llqhz
 * @Date:   2017-09-19 10:25:17
 * @Last Modified by:   llqhz
 * @Last Modified time: 2017-11-22 21:42:21
 */



/**
 * 交换两个数
 * @param  &$a &$b
 */
function swap( &$a, &$b ) {
    list($a,$b) = array($b,$a);
}




/**
 * 排序算法：  冒泡排序
 * 时间复杂度：O(n^2)    空间复杂度：O(n)
 * 原理：      通过嵌套的两次循环，内存循环将相邻元素大者后移，
 *             外层循环控制循环轮数，不断后大的方向冒泡
 * @param  array &$a 要排序的数组
 * @return none      引用排序
 */
function  bubbleSort( &$a ) {
    $l = count($a);
        // 控制多少轮循环
    for ($i=$l-1; $i >= 1; $i--) {
            //一轮冒泡 最大的元素会排好
        for ($j=0; $j < $i; $j++) {
            //相邻元素，大者后移
            if ( $a[$j] > $a[$j+1] ) {
                swap( $a[$j], $a[$j+1] );
            }
        }
    }
}



/**
 * 排序算法： 插入排序
 * 原理：后一个元素{$i}在前部分已经排序元素中依次交换前进
 *       找到其正确位置
 */
function insertSort( &$a ) {
    $l = count($a);
    //$i前面已经排好序
    for ($i=1; $i < $l; $i++) {
        //交换前进找到最后元素正确的位置
        for ($j=$i; $j > 0; $j--) {
            if ( $a[$j] < $a[$j-1] ) {
                swap($a[$j],$a[$j-1]);
            } else {
                break;
            }
        }
    }
}

/**
 * 插入排序   PHP改进版
 * 改进原理:  用临时变量保存$i的值,前面依次后移,空出$i的位置
 *            然后再让该位置等于$i
 */
function insertSortS( &$a ) {
    $l = count( $a );
    for ($i=1; $i < $l; $i++) {
        $tmp = $a[$i];   //保存$a[$j]的值
        for ($j=$i; $j > 0; $j--) {
            //注意tmp与a[j-1]比较,并且a[j]与a[j-1]交换
            if ( $a[$j-1] > $tmp ) {
                //< 和 > 控制顺序还是逆序
                $a[$j] = $a[$j-1];
            } else {
                break;
            }
        }
        $a[$j] = $tmp;
        /*foreach ($a as $k => $v) {
            echo $v,' '; //输出排序过程
        }
        echo "<br>";*/
    }
}




/**
 * 排序算法:  选择排序
 * 时间复杂度：O(n^2)    空间复杂度：O(n)
 * @param  &$a 要排序的数组
 * 原理:   在[$i,$l]中依次寻找最小者放到$i位置
 *         始终保持前部分有序并且后部分元素皆大于前部分
 */
function selectSort( &$a ) {
    $l = count($a);
    if ($l < 2) return;
    //$i之前有序 [$i 无序
    for ($i=0; $i < $l-1; $i++) {
        //在[$i,$l]中依次寻找最小者放到$i位置
        $min = $i;
        for ($j=$i+1; $j < $l; $j++) {
            if ( $a[$j] < $a[$min] ) {
                $min = $j;
            }
        }
        if ($min != $i) {
            swap($a[$min],$a[$i]);
        }
    }
}


/**
 * 排序算法:  归并排序
 * 时间复杂度：O(lg(n))    空间复杂度：O(n)
 * @param  &$a 要排序的数组
 * 原理:   采用分治法,将数组拆分为两部分,两部分分别排好序后
 *         再合并两部分结果,并递归调用该过程
 */
function merge( &$a, $lo, $mid, $hi) {
    //两部分 a[lo,mid]  a[mid+1,hi]
    $i = $lo; $j = $mid+1;
    $aux = array();
    // 保存$a到辅助数组
    for ($k=$lo; $k <= $hi; $k++) {
        $aux[$k] = $a[$k];
    }
    //比较两部分的最小元素取完lo->hi
    for ($k=$lo; $k <= $hi; $k++) {
        //先判断是否已取完
        if ( $i > $mid ) { //左边取完
            $a[$k] = $aux[$j++];
        } elseif ( $j > $hi ) { //右边取完
            $a[$k] = $aux[$i++];
        } else {
            //取两部分较小者
            $a[$k] = ( $aux[$i]<$aux[$j] ) ? $aux[$i++] : $aux[$j++];
        }
    }
}
function msort( &$a, $lo, $hi ) {
    if ( $hi <= $lo ) {
        return ;    //基准情况
    }
    $mid =  $lo + floor( ($hi-$lo)/2 );
    //先排左边,再排右边,最后归并
    msort( $a, $lo, $mid );
    msort( $a, $mid+1, $hi );
    merge( $a, $lo, $mid, $hi );

}
function mergeSort( &$arr )
{
    msort( $arr, 0, count($arr)-1 );
}



function test($fun){
    $arr = [2,9,4,6,1,3,7,5,8];
    var_dump($arr);
    $fun($arr);
    var_dump($arr);
}

test('quickSort');

die();


/* 快速排序 */
function partition(&$a, $lo, $hi)
{
    //将数组切分为a[lo->i-1]<=a[i]<=a[i+1->j]有序
    $i = $lo; $j = $hi+1;
    $v = $a[$lo];   //切分元素
    while ( true ) {
        //右向寻找低于切分值的元素,直到最右端($a[$hi])停止
        while ( $a[++$i] > $v ) {
            if ( $i >= $hi ) {
                break;
            }
        }
        //左向寻找高于切分值的元素,直到最左端($a[$lo+1])停止
        while ( $a[--$j] < $v ) {
            if ( $j <= ($lo+1) ){
                break;
            }
        }
        //设定切分终止条件 指针相遇或者交叉越界 两端都已满足顺序 不再交换
        if ( $j <= $i ) {
            break; //终止外层循环
        }
        //交换使切分左右有序
        swap($a[$i], $a[$j]);
    }
    //将$a[$lo] 加入$a[$j]的位置 因为$a[$j]<=$v的
    swap($a[$lo], $a[$j]);

    return $j;
}



/*快速排序 递归 */
function qsort(&$a, $lo, $hi)
{
    //基准 只有一个元素,不再排序
    if ( $lo >= $hi ) return;
    $p = partition( $a, $lo, $hi );
    qsort( $a, $lo, $p-1 );
    qsort( $a, $p+1, $hi );
}
function quickSort(&$a)
{
    shuffle($a);
    qsort($a, 0, count($a)-1);
}








