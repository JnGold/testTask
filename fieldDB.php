
<?php

// Connecting db

$dsn = 'mysql:host=localhost;dbname=testtaskdb';
$user = 'root';
$password = '.G9fw32l3';
try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}


// Get all posts and comments
$posts = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'), TRUE);
$comments = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/comments'), TRUE);


// Load posts in db
$postsQuantity = 0;
foreach ($posts as $post){
    $stmt = $pdo->prepare('INSERT INTO posts(userId, id, title, body) VALUES (?, ?, ?, ?)');
    $stmt->execute(array_values($post));
    $postsQuantity++;
}

// Load comments in db
$commentsQuantity = 0;
foreach ($comments as $comment){
    $stmt = $pdo->prepare('INSERT INTO comments(postId, id, name, email, body) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array_values($comment));
    $commentsQuantity++;
}

echo 'Загружено '.$postsQuantity.' записей и '.$commentsQuantity.' комментариев';


