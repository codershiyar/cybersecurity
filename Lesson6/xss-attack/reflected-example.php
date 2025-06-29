<?php
if (isset($_GET['search_query'])) {
    // Reflect the user input directly into the page (VULNERABLE TO XSS)
    echo "Search results for: " . htmlspecialchars($_GET['search_query']);
}
?>

<!-- Simple search form for users -->
<form method="get">
    <input type="text" name="search_query" placeholder="Enter your search term">
    <button type="submit">Search</button>
</form>
