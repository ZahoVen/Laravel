<?php

require_once __DIR__ . '/task.php';

/**
 * Generate documentation for the BookCollection and Book classes using the Reflection API
 */


$bookCollectionReflection = new ReflectionClass('BookCollection');

echo "Class {$bookCollectionReflection->getName()}:\n";
echo "{$bookCollectionReflection->getDocComment()}\n";

foreach ($bookCollectionReflection->getMethods() as $method) {
    echo "{$method->getName()}():\n";
    echo "{$method->getDocComment()}\n";
}

$bookReflection = new ReflectionClass('Book');

echo "Class {$bookReflection->getName()}:\n";
echo "{$bookReflection->getDocComment()}\n";

foreach ($bookReflection->getMethods() as $method) {
    echo "{$method->getName()}():\n";
    echo "{$method->getDocComment()}\n";
}

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
