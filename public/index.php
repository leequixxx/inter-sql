<?php

$config = require_once __DIR__ . '/../database.php';

$pdo = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);

$statement = $pdo->query('SELECT books.id, title, price, a.name as authorName FROM books LEFT JOIN authors a ON books.author_id = a.id');
$allBooks = $statement->fetchAll(PDO::FETCH_CLASS);

$statement = $pdo->query('SELECT authors.id, name FROM authors LEFT JOIN books b ON b.author_id = authors.id WHERE b.title IS NULL GROUP BY id');
$authorsWithoutBooks = $statement->fetchAll(PDO::FETCH_CLASS);

$statement = $pdo->query('SELECT authors.id, name FROM authors RIGHT JOIN books b ON b.author_id = authors.id GROUP BY id');
$authorsWithBooks = $statement->fetchAll(PDO::FETCH_CLASS);

require_once __DIR__ . '/../template.phtml';