<?php

namespace Blog\Entity;

class Post {
    private int $id;
    private string $title;
    private string $content;
    private string $publishDate;
    private Author $author;
    private Category $category;
    private int $views;
    private string $status;

    public function __construct(int $id,string $title,string $content, Author $author,Category $category,string $publishDate) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->category = $category;
        $this->publishDate  = $publishDate;

        $this->views = 0;
        $this->status = "draft";
        
    }
    public function publish(): void {
        $this->status = "published";
    }
    public function incrementViews(): void {
        $this->views ++;
    }
    public function isPublished(): bool {
        return $this->status === "published";
    }
    public function getExcerpt(int $length = 100): string {
        if (strlen($this->content)<= $length) {
            return $this->content;
        }
        return substr($this->content, 0 , $length). "...";
    }
    public function getId(): int {
        return $this->id;
    }
    public function getTitle(): string {
        return $this->title;
    }
    public function getContent(): string {
        return $this->content;
    }
    public function getPublishDate(): string {
        return $this->publishDate;
    }
    public function getAuthor(): Author {
        return $this->author;
    }
    public function getCategory(): Category {
        return $this->category;
    }
    public function getViews(): int {
        return $this->views;
    }
    public function getStatus(): string {
        return $this->status;
    }
    public function __toString(): string {
        return "{$this->title} by {$this->author->getName()}";
    }
}
?>
