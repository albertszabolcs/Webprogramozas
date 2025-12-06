<?php

namespace Blog\Service;

use Blog\Entity\Post;
use Blog\Service\PostManager;

class Statistics {
    private PostManager $postManager;

    public function __construct(PostManager $postManager) {
        $this->postManager = $postManager;
    }
    public function getTotalViews(): int {
        return array_reduce($this->postManager->getAllPosts(), fn(int $carry, Post $post) => $carry + $post->getViews(),0);
    }
    public function getAverageViews(): float {
        $posts = $this->postManager->getAllPosts();
        $totalPosts = count($posts);

        if($totalPosts === 0) {
            return 0;
        }
        return $this->getTotalViews() / $totalPosts;
    }
    public function getPublishRate(): float {
        $posts = $this->postManager->getAllPosts();
        $totalPosts = count($posts);

        if($totalPosts === 0) {
            return 0;
        }
        $publishedCount = count(array_filter($posts, fn($post) => $post->isPublished()));
        return ($publishedCount / $totalPosts)* 100;
    }
}
?>
