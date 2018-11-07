<?php
if (isset($_POST['category']) && !empty($_POST['category'])) {
    $filter = $_POST['category'];

    // include connection file
    include 'inc/connect.php';

    $sql = "SELECT menu_id, menu_name, menu_price, menu_description, categories.category_title 
    FROM menu 
    LEFT JOIN categories 
    ON (categories.category_id = menu.categories_category_id) 
    WHERE categories.category_id > 4";

    $where = "";
    $orderBy = " ORDER BY categories.category_title ASC";

    // If there is no filter, return all results
    if (!isset($filter) || $filter == null || $filter == 'All') {
        // prepare
        $stmt = $this->$pdo->prepare($sql . $orderBy);
        // execute
        $stmt->execute();
        return $stmt;
    // Else return the filtered category value results
    } else {
        switch ($filter) {
            case 'Handhelds':
            $where = " AND categories.category_title = 'Handhelds'";
            break;
            case 'Salads':
            $where = " AND categories.category_title = 'Salads'";
            break;
            case 'Entree':
            $where = " AND categories.category_title = 'Entree'";
            break;
            case 'Dessert':
            $where = " AND categories.category_title = 'Dessert'";
            break;
        }
        // prepare
        $stmt = $this->$pdo->prepare($sql . $where . $orderBy);
        // execute
        $stmt->execute();
        return $stmt;
    }
} else {
    echo "Error!";
}
