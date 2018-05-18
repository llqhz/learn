<?php
/**
 * @Author: Marte
 * @Date:   2018-05-18 11:25:13
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-18 11:29:05
 */
$step_1 = 'git add .';
$step_2 = 'git commit -m " commit at '.date('Y-m-d H:i:s').' "';
$step_3 = 'git push origin';
shell_exec($step_1);
shell_exec($step_2);
$res = shell_exec($step_3);
var_dump($res);
