<?php

$config = require_once('config.php');
$db = $config['db'];
$pdo = new PDO($db['dsn'], $db['user'], $db['password']);
$aliases = ["id"=>"id", "user_id"=>"userId", "title"=>"title", "body"=>"body"];
echo("Import Posts :");
import_data('https://jsonplaceholder.typicode.com/posts', 'posts', $aliases );
$aliases = ["id"=>"id", "post_id"=>"postId", "name"=>"name", "email"=>"email", "body"=>"body"];
echo("Import Comments :");
import_data('https://jsonplaceholder.typicode.com/comments', 'comments', $aliases );

// $aliases нужен для соотнесения названий полей в БД и входном JSON массиве 
function import_data($url, $table, $aliases){
    global $pdo;
    if(!$pdo){
        throw new Exception("Error: PDO class undefined.");
    }
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    if($err = curl_error($curl)) {
        echo $err;
        curl_close($curl);
        return;
    } 
    $posts = json_decode($response);
    $posts_count = 0;
    $query = "INSERT INTO `".$table."` ";
    array_walk($posts, function($item, $key)use($pdo, &$posts_count, $aliases, $query){
        $keys = array_keys($aliases);
        $keys_with_quote = array_map(function($item)use(&$values, $aliases){
            $values[] = "`".$aliases[$item]."`";
            return "`".$item."`";},
            $keys);
        $query .= '('.implode(', ', $keys_with_quote).')';
        $query .= " VALUES ";
        $values_with_quote = array_map(function($key)use($aliases, $item){return "'".$item->{$aliases[$key]}."'" ??"'null'"; }, $keys );
        $query .= '('.implode(', ', $values_with_quote).')';
        try{
            $pdo->exec( $query );
            $posts_count++;
        }catch(PDOException $err){
            print "<div style='background-color:red; margin:1px 0px; color:white'>Error: " . $err->getMessage()."</div>";
        }
    });
    echo( "<div style='background-color:green; margin:1px 0px; padding:15px; color:white'> Добавлено записей: ".$posts_count."</div>");
    curl_close($curl);
}


