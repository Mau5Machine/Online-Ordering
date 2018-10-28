<?php
$pageTitle = "Package Details";
include 'inc/connect.php';

// Check for the package id in the URL
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = $_GET['id'];

    // Prepare a sql statement
    $sql = "SELECT menu_id, menu_name, menu_price, menu_description, categories.category_title 
    FROM menu
    LEFT JOIN categories ON (categories.category_id = menu.categories_category_id)
    WHERE menu_id = :id";

    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                // Fetch the result as an associative array
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Grab Field Values
                $title = $row['menu_name'];
                $price = $row['menu_price'];
                $description = $row['menu_description'];
                $category = $row['category_title'];
            } else {
                // URL is invalid parameter
                header("location: error.php");
                exit();
            }
        } else {
            header("location: error.php");
        }
    }
    unset($stmt);

    unset($pdo);
} else {
    header("location: error.php");
    exit();
}
?>

<?php
include_once 'inc/header.php';
?>

<article id="details">
    <?php
        echo "<h1>" . $title . "</h1>";
        $item_description = htmlspecialchars_decode(htmlspecialchars_decode($row['menu_description']));
    ?>
    <?= $item_description ?>
</article>

<?php
include_once 'inc/footer.php';
?>