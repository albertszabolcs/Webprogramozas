<?php


class Book
{
    public string $title;
    public float $price;
    public Author $author;

   public function __construct(string $title, float $price, Author $author)
   {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
   }
   public function getTitle(): string
   {
        return $this->title;
   }
   public function setTitle(string $title): void
   {
        $this->title = $title;
   }
   public function getName(): string
   {
        return $this->title;
   }
   public function getAuthor(): Author
   {
        return $this->author;

   }
   public function getPrice(): float
   {
        return $this->price;
   }
   public function setPrice(float $price): void
   {
        $this->price = $price;
   }
   public function setAuthor(Author $author): void
   {
        $this->author = $author;
   }
}
?>