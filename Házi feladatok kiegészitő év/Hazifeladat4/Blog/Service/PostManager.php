<?php

namespace Blog\Service;

use Blog\Entity\Post;
use Blog\Entity\Author;
use Blog\Entity\Category;

class PostManager
{
    private array $posts = [];


    public function addPost(Post $post): void
    {
        $this->posts[] = $post;
    }

    public function getPostById(int $id): ?Post
    {
        foreach ($this->posts as $post) {
            if ($post->getId() === $id) {
                return $post;
            }
        }
        return null;
    }

    public function getPublishedPosts(): array
    {
        return array_filter($this->posts, fn(Post $post) => $post->isPublished());

    }

    public function getPostsByAuthor(Author $author): array
    {
        return array_filter($this->posts, fn(Post $post) => $post->getAuthor()->getId() === $author->getId());
    }

    public function getPostsByCategory(Category $category): array
    {
        return array_filter($this->posts, fn(Post $post) => $post->getCategory()->getId() === $category->getId());
    }

    public function getMostViewedPosts(int $limit = 5): array
    {
        $posts = $this->posts;

        usort($posts, fn(Post $a, Post $b) => $b->getViews() <=> $a->getViews());

        return array_slice($posts, 0, $limit);
    }

    public function getAllPosts(): array
    {
        return $this->posts;
    }
}
?>

