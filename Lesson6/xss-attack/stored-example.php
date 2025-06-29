<?php
$databaseConnection = new PDO("mysql:host=localhost;dbname=test_db", "root", "");

// Handle comment submission
if (isset($_POST['user_comment'])) {
    $insertCommentQuery = $databaseConnection->prepare(
        "INSERT INTO comments (comment) VALUES (:user_comment)"
    );
    $insertCommentQuery->execute(['user_comment' => htmlspecialchars($_POST['user_comment']) ]);
}

$selectCommentsQuery = $databaseConnection->query("SELECT * FROM comments");

// Display all comments (VULNERABLE to XSS)
while ($commentRow = $selectCommentsQuery->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>" . $commentRow['comment'] . "</p>";
}
?>

<form method="post">
    <textarea rows="5" cols="33" name="user_comment" 
      placeholder="Write your comment here...">
    </textarea>
    <br>
    <button type="submit">Submit Comment</button>
</form>