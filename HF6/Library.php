<?php
require_once "AbstractLibrary.php";

class Library extends AbstractLibrary
{
    /** @var Author [] */
    private $authors = [];

    public function addAuthor(string $authorName): Author
    {
         if (isset($this->authors[$authorName])) {
            return $this->authors[$authorName];
        }
        $author = new Author($authorName);
        $this->authors[$authorName] = $author;
        return $author;
    }
    public function addBookForAuthor($authorName, Book $book)
    {
            if(isset($this->authors[$authorName])) {
                $author = $this->authors[$authorName];
                $author->addBook($book->getName(), $book->getPrice());
                $book->setAuthor($author);
            } else {
                echo "Szerző nem találhato: $authorName\n";
            }
    }
    public function getBooksForAuthor($authorName): array
    {
        if(isset($this->authors[$authorName])) {
            return $this->authors[$authorName]->getBooks();
        }
        return [];
    }
    public function search(string $bookName): Book
    {
        foreach($this->authors as $author) {
            foreach($author->getBooks()as $book) {
                if($book->getName() === $bookName) {
                    return $book;
                }
            }
        }
        return null;
    }
    public function print(): void
    {
        foreach ($this->authors as $author) {
            echo $author->getName() . "<br>";
            echo "--------------------<br>";
        foreach ($author->getBooks() as $book) {
            echo $book->getTitle() . ' - ' . $book->getPrice() . "<br>";
        }
        echo "<br>";
    }
}
}
?>



