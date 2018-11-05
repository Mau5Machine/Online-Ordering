<?php
// Menu Object
class Menu
{

    // database connection and table name
    private $conn;
    private $table_name = "menu";

    // Object properties
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $category_title;

    // constructor
    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    // read all menu items
    public function read($from_record_num, $items_per_page)
    {

        // select all menu items query
        $sql = "SELECT menu_id, menu_name, menu_description, menu_price, categories_category_id, categories.category_title
        FROM menu
        LEFT JOIN categories
        ON (categories.category_id = menu.categories_category_id)
        LIMIT ?, ?";

        // prepare sql statements
        $stmt = $this->conn->prepare($sql);

        // bind limit clause variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $items_per_page, PDO::PARAM_INT);

        // Execute query
        $stmt->execute();

        // return values
        return $stmt;
    }

    // used for paging the menu items
    public function count()
    {
        // query to count all menu items from db
        $sql = "SELECT count(*) FROM " . $this->table_name;

        // prepare statement
        $stmt = $this->conn->prepare($sql);

        // execute
        $stmt->execute();

        // get row value
        $rows = $stmt->fetch(PDO::FETCH_NUM);

        // return count
        return $rows[0];
    }

    // read all menu items based on menu ids included in the $ids variable
    public function readByIds($ids)
    {
        $ids_arr = str_repeat('?,', count($ids) - 1) . '?';
 
        // query to select items
        $sql = "SELECT menu_id, menu_name, menu_price FROM " . $this->table_name . " WHERE menu_id IN ({$ids_arr}) ORDER BY menu_name";
 
        // prepare query statement
        $stmt = $this->conn->prepare($sql);
 
        // execute query
        $stmt->execute($ids);
 
        // return values from database
        return $stmt;
    }

    // Check if a cart item exists
    public function exists()
    {

        // query to count existing cart item
    }

    // function to read by category
    public function get_packages()
    {
        $sql = "SELECT menu_id, menu_name, menu_price, menu_description, categories.category_title 
              FROM menu 
              LEFT JOIN categories 
              ON (categories.category_id = menu.categories_category_id) 
              WHERE menu.categories_category_id < 5";

        // prepare
        $stmt = $this->conn->prepare($sql);

        // execute
        $stmt->execute();

        return $stmt;
    }

    // function to get menu_items
    public function get_menu($filter = null)
    {
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
            $stmt = $this->conn->prepare($sql . $orderBy);
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
            $stmt = $this->conn->prepare($sql . $where . $orderBy);
            // execute
            $stmt->execute();
            return $stmt;
        }
    }
}
