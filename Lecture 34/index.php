<?php

// Include the Book and Library classes
require_once __DIR__ . '\books.php';
require_once __DIR__ . '\library.php';

// Create a new Library object
$library = new Library();

// Create several Book objects and add them to the library
$book1 = new Book("The Catcher in the Rye", "J.D. Salinger", 1951, "978-0316769488");
$book2 = new Book("Pride and Prejudice", "Jane Austen", 1813, "978-0486284736");
$book3 = new Book("1984", "George Orwell", 1949, "978-0451524935");

$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Add another book to the library
$book4 = new Book("To Kill a Mockingbird", "Harper Lee", 1960, "978-0446310789");
$library->addBook($book4);

// Remove a book from the library
$library->removeBook("978-0486284736");

// Locate a book in the library
$foundBook = $library->findBook("978-0316769488");

// Clone a book in the library and update its ISBN
$clonedBook = $library->cloneBook("978-0451524935");
$clonedBook->setISBN("978-1984clone");

// Print the final list of books in the library
$booksInLibrary = $library->getBooks();
foreach ($booksInLibrary as $book) {
    echo $book . PHP_EOL;
}




