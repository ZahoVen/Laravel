<?php

class BookCollection implements ArrayAccess, Countable {
    private $books = [];

    public function addBook($book) {
        $this->books[] = $book;
    }

    public function getBook() {
        return $this->books;
    }

    public function offsetExists($offset) {
        return isset($this->books[$offset]);
    }

    public function offsetGet($offset) {
        return $this->books[$offset];
    }

    public function offsetSet($offset, $value) {
        if ($offset === null) {
            $this->books[] = $value;
        } else {
            $this->books[$offset] = $value;
        }
    }

    public function offsetUnset($offset) {
        unset($this->books[$offset]);
    }

    public function count() {
        return count($this->books);
    }

    public function __clone() {
        // Clone the books array to create a deep copy
        $this->books = array_map(fn($book) => clone $book, $this->books);
    }

    public function __serialize(): array {
        // Serialize the books array by calling __serialize on each book
        return array_map(fn($book) => $book->__serialize(), $this->books);
    }

    public function __unserialize(array $data): void {
        // Unserialize the books array by creating new Book objects from the serialized data
        $this->books = array_map(function($bookData) {
            $book = new Book();
            $book->__unserialize($bookData);
            return $book;
        }, $data);
    }
}

class Book {
    public $title;
    public $author;

    public function __serialize(): array {
        // Serialize the Book object as an associative array
        return [
            'title' => $this->title,
            'author' => $this->author,
        ];
    }

    public function __unserialize(array $data): void {
        // Unserialize the Book object from an associative array
        $this->title = $data['title'];
        $this->author = $data['author'];
    }
}

