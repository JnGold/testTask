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

// Search for comments on a part of the text
$textPart = $_GET['textPart'];
$stmt = $pdo->query('SELECT comments.postId, posts.title, comments.body FROM comments INNER JOIN posts ON comments.postId = posts.id 
WHERE comments.body LIKE "%' . $textPart . '%" ORDER BY postId');

$matchingPosts = [];

while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
        echo "<h1 > {$row["title"]}       ({$row['postId']})</h1 > ";
        echo "<p> {$row['body']} </p ><br > ";
}
