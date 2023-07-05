<?php

class Book {
    public $title;
    public $author;
    public $publicYear;
    public $isbn;

    public function __construct($title, $author, $publicYear, $isbn){
        $this->title = $title;
        $this->author = $author;
        $this->publicYear = $publicYear;
        $this->isbn = $isbn;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPublicationYear() {
        return $this->publicYear;
    }

    public function getISBN() {
        return $this->isbn;
    }

    public function setISBN($newISBN) {
        $this->isbn = $newISBN;
    }

    public function __toString() {
        return sprintf("%s by %s (%d) - ISBN: %s", $this->title, $this->author, $this->publicYear, $this->isbn);
    }

    public function __clone() {
        $this->isbn = "COPY_" . $this->isbn;
    }

}