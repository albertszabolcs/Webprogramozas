<?php

// JSON adatok
$jsonData = '[
    {
        "title": "The Catcher in the Rye",
        "author": "J.D. Salinger",
        "publication_year": 1951,
        "category": "Fiction"
    },
    {
        "title": "To Kill a Mockingbird",
        "author": "Harper Lee",
        "publication_year": 1960,
        "category": "Fiction"
    },
    {
        "title": "1984",
        "author": "George Orwell",
        "publication_year": 1949,
        "category": "Dystopian"
    },
    {
        "title": "The Great Gatsby",
        "author": "F. Scott Fitzgerald",
        "publication_year": 1925,
        "category": "Fiction"
    },
    {
        "title": "Brave New World",
        "author": "Aldous Huxley",
        "publication_year": 1932,
        "category": "Dystopian"
    }
]';

// 1. JSON dekódolása PHP tömbbé
$books = json_decode($jsonData, true);

// 2. Könyvek rendezése kategóriák szerint
$categorizedBooks = [];
foreach ($books as $book) {
    $category = $book['category'];
    if (!isset($categorizedBooks[$category])) {
        $categorizedBooks[$category] = [];
    }
    $categorizedBooks[$category][] = $book;
}

// 3. HTML táblázat generálása
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<thead><tr><th>Kategória</th><th>Könyv címe</th><th>Szerző</th><th>Kiadási év</th></tr></thead>";
echo "<tbody>";

foreach ($categorizedBooks as $category => $books) {
    echo "<tr><td colspan='4' style='background-color: #f2f2f2; text-align: center;'><strong>{$category}</strong></td></tr>";
    foreach ($books as $book) {
        echo "<tr>";
        echo "<td></td>"; // Üres cella a kategória oszlopához
        echo "<td>{$book['title']}</td>";
        echo "<td>{$book['author']}</td>";
        echo "<td>{$book['publication_year']}</td>";
        echo "</tr>";
    }
}

echo "</tbody>";
echo "</table>";
?>