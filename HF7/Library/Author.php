<?php

namespace Library;
class Author
{
    public string $name;
    public $books = [];

   public function __construct(string $name,$books= [])
   {
        $this->name = $name;
        $this->books = $books;
   }
   public function getName(): string
   {
        return $this->name;
   }
   public function setName(string $name): void
   {
        $this->name = $name;
   }
   public function getBooks(): array
   {

        return $this->books;
   }
   public function setBooks(array $books): void
   {
        $this->books = $books;
   }
    /**
     * @param string $title
     * @param float  $price
     * @return \Book
     */
    public function addBook(string $title, float $price): void
    {
        $book = new Book($title, $price, $this);
        $this->books[] = $book;
    }
}
?>