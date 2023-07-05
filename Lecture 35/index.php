<?php

require_once __DIR__ . '/task.php';

$book1 = new Book();
$book1->title = "Book 1";
$book1->author = "Author 1";

$book2 = new Book();
$book2->title = "Book 2";
$book2->author = "Author 2";

// Create a book collection
$bookCollection = new BookCollection();
$bookCollection->addBook($book1);
$bookCollection->addBook($book2);

$serialized = serialize($bookCollection);

$deserialized = unserialize($serialized);

$book1->title = "Modified Book 1";

echo "Original:\n";
print_r($bookCollection->getBook());

echo "Deserialized:\n";
print_r($deserialized->getBook());
