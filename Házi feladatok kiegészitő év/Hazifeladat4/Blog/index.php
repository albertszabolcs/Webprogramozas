<?php

require_once 'autoload.php';

use Blog\Entity\Author;
use Blog\Entity\Category;
use Blog\Entity\Post ;
use Blog\Entity\Comment ;
use Blog\Service\PostManager ;
use Blog\Service\Statistics ;
use Blog\Exception\ValidationException ;

$author1 = new Author (1,"Peter Alpar","peteralpar24@gmail.com","web fejlesztő");
$author2 = new Author(2,"Mark Aron","aronmark10@gmail.com","tartalom készitő");
$author3 = new Author(3,"Marton Istvan","martonisti4@gmail.com","tervező");

$category1 = new Category(1,"PHP","php");
$category2 = new Category(2,"Javascript","javascript");
$category3 = new Category(3,"Web fejlesztő","web-fejlesztő");

$postManager = new PostManager();

$post1 = new Post(1,"PHP alapok","Tartalom a PHP alapjairol",$author1,$category1,"2025-11-28");
$post2 = new Post(2, "Haladó PHP", "Tartalom a haladó PHP témákról", $author1, $category1, "2025-11-27");
$post3 = new Post(3, "JavaScript tippek", "Tartalom a JavaScript-ről", $author2, $category2, "2025-11-29");
$post4 = new Post(4, "JS Aszinkron", "Tartalom az aszinkron JS-ről", $author2, $category2, "2025-11-26");
$post5 = new Post(5, "Webdesign alapok", "Tartalom a webdesign-ról", $author3, $category3, "2025-11-25");
$post6 = new Post(6, "CSS trükkök", "Tartalom a CSS trükkökről", $author3, $category3, "2025-11-24");
$post7 = new Post(7, "HTML űrlapok", "Tartalom a HTML űrlapokról", $author1, $category3, "2025-11-23");
$post8 = new Post(8, "JS keretrendszerek", "Tartalom a JS keretrendszerekről", $author2, $category2, "2025-11-22");

$postManager->addPost($post1);
$postManager->addPost($post2);
$postManager->addPost($post3);
$postManager->addPost($post4);
$postManager->addPost($post5);
$postManager->addPost($post6);
$postManager->addPost($post7);
$postManager->addPost($post8);

$comment1 = new Comment(1,$post1,'Béla','Nagyon hasznos bejegyzés a PHP-rol','2025-11-28');
$comment2 = new Comment(2, $post2, 'Éva', 'Szuper tippek a haladó PHP-hez', '2025-11-28');
$comment3 = new Comment(3, $post3, 'Gábor', 'Köszönöm a JavaScript tippeket!', '2025-11-27');
$comment4 = new Comment(4, $post5, 'Anna', 'Nagyon tetszik a webdesign magyarázat', '2025-11-26');
$comment5 = new Comment(5, $post6, 'László', 'A CSS trükkök nagyon jól jönnek!', '2025-11-26');


try {
    $author = new Author(4, 'Peter Ferenc', 'peterferenc@gmail.com', 'web fejlesztő');
} catch (ValidationException $e) {
    echo "Hiba a szerző létrehozásánál: " . $e->getMessage();
}

try {
    $comment = new Comment(5, $post1, 'Ferenc Pista', 'Fontos tudnivalok', '2025-11-28');
} catch (ValidationException $e) {
    echo "Hiba a komment létrehozásánál: " . $e->getMessage();
}

try {
    $post = new Post(10, '', 'Valaki tud rola informáciot?', $author1, $category1, '2025-11-28');
} catch (ValidationException $e) {
    echo "Hiba a post létrehozásánál: " . $e->getMessage() . PHP_EOL;
}

$post1->publish();
$post3->publish();
$post5->publish();

$publishedPosts = $postManager->getPublishedPosts();
foreach($publishedPosts as $post) {
    echo $post . "<br>";
}

$authorPosts = $postManager->getPostsByAuthor($author1);
echo "Postok {$author1->getName()} által:<br>";
foreach ($authorPosts as $post) {
    echo $post . "<br>";
}

$categoryPosts = $postManager->getPostsByCategory($category1);
echo "Postok a '{$category1->getName()}' kategoriában:<br>";
foreach ($categoryPosts as $post) {
    echo $post . "<br>";
}
    $post1->incrementViews();
    $post2->incrementViews();
    $post3->incrementViews();
    $post4->incrementViews();
    $post5->incrementViews();

    $Posts = $postManager->getMostViewedPosts(3);
    echo "Legtöbbet nézett postok:<br>";
    foreach ($Posts as $post) {
        echo $post . "Nézettség: " . $post->getViews() . "<br>";
    }

    $stats = new Statistics($postManager);
    echo "Összes nézettség: " . $stats->getTotalViews() . "<br>";
    echo "Átlagos nézettség: " . $stats->getAverageViews() . "<br>";
    echo "Publikált posztok aránya: " . $stats->getPublishRate() . "<br>";
?>


