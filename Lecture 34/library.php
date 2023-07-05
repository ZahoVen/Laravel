<?php
class Library {
    private $books = array();

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function removeBook($isbn) {
        foreach ($this->books as $key => $book) {
            if ($book->getISBN() == $isbn) {
                unset($this->books[$key]);
                return true;
            }
        }
        return false;
    }

    public function findBook($isbn) {
        foreach ($this->books as $book) {
            if ($book->getISBN() == $isbn) {
                return $book;
            }
        }
        return null;
    }

    public function cloneBook($isbn) {
        foreach ($this->books as $book) {
            if ($book->getISBN() == $isbn) {
                $clonedBook = clone $book;
                $clonedBook->setISBN("COPY_" . $clonedBook->getISBN());
                $this->books[] = $clonedBook;
                return $clonedBook;
            }
        }
        return null;
    }

    public function getBooks() {
        return $this->books;
    }
}

