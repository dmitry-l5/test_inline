<?php
$config = require_once('config.php');
$db = $config['db'];
$pdo = new PDO($db['dsn'], $db['user'], $db['password']);
$posts = file_get_contents('sql/posts.sql');
$pdo->exec($posts);
$comments = file_get_contents('sql/comments.sql');
$pdo->exec($comments);
