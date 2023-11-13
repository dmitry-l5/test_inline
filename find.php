<?php
$config = require_once('config.php');
$db = $config['db'];
$pdo = new PDO($db['dsn'], $db['user'], $db['password']);
$query = 
'SELECT `comments`.`post_id`, group_concat(`comments`.`id` SEPARATOR ", " ) as comments FROM `inline_test`.`comments` INNER JOIN posts on `comments`.`post_id` = `posts`.`id` where (`comments`.`body` like "%'.$_POST['find'].'%") group by `post_id`;';
$indexes = $pdo->query($query, PDO::FETCH_NAMED)->fetchAll();
$result = [];
array_walk($indexes, function($value, $key)use(&$result, $pdo){
    $item = [
        'post' => $pdo->query("select * from posts where id = ".$value['post_id'].";", PDO::FETCH_NAMED)->fetch(),
        'comments' => $pdo->query("select * from comments where id in (".$value['comments'].");", PDO::FETCH_NAMED)->fetchAll(),
    ];
    $result[] = $item;
});
echo(json_encode($result));