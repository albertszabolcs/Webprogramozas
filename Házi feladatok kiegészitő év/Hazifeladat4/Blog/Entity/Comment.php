<?php

namespace Blog\Entity;

use Cassandra\Exception\ValidationException;

class Comment
{
    private int $id;
    private Post $post;
    private string $authorName;
    private string $content;
    private string $createdAt;
    private bool $approved;

    public function __construct(int $id, Post $post, string $authorName, string $content, string $createdAt)
    {
        $this->id = $id;
        $this->post = $post;
        $this->authorName = $authorName;
        $this->content = $content;
        $this->createdAt = $createdAt;

        if (strlen($content) < 10) {
            throw new ValidationException("Comment must be at least  10 characters long");

            $this->approved = false;
        }
    }

    public function approve(): void
    {
        $this->approved = true;
    }

    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function geId(): int
    {
        return $this->id;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
    public function __toString(): string {
        $expertLength = 50;
        $excerpt = strlen($this->content) > $expertLength ? substr($this->content, 0, $expertLength) . "..."
        :$this->content;

        return "Comment by {$this->authorName}: {$excerpt}";
    }
}
?>
