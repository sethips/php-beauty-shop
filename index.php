<?php require_once "includes/db.php"; ?>
<?php include "includes/get-products.php"; ?>
<?php include "includes/get-products-in-category.php"; ?>
<?php include "includes/get-products-search.php"; ?>

<?php

    //routing
    $request = $_SERVER["REQUEST_URI"];
    switch ($request) {
        case '/' :
            include "includes/header.php";
            require __DIR__ . '/views/home.php';
            include "includes/footer.php";
            break;
        case '' :
            include "includes/header.php";
            require __DIR__ . '/views/home.php';
            include "includes/footer.php";
            break;
        case '/shop':
            include "includes/header.php";
            require __DIR__ . '/views/shop.php';
            include "includes/footer.php";
            break;
        case '/skin-care':
            include "includes/header.php";
            require __DIR__ . '/views/skin_care.php';
            include "includes/footer.php";
            break;
        case '/about':
            include "includes/header.php";
            require __DIR__ . '/views/about.php';
            include "includes/footer.php";
            break;
        case '/product?name=' .substr($request, 14, strlen($request) ):
            include "includes/header.php";
            require __DIR__ . '/views/product.php';
            include "includes/footer.php";
            break;
        case '/basket':
            include "includes/header.php";
            require __DIR__ . '/views/basket.php';
            include "includes/footer.php";
            break;
        case '/api/products':
            $data = getProducts($conn);
            echo json_encode($data, JSON_PRETTY_PRINT);
            //print_r($arr);
            break;
        case '/api/category/' .substr($request, 14, strlen($request) ):
            $category = substr($request, 14, strlen($request));
            $category = preg_replace("/_/", " ", $category);
            $data = getProductsInCategory($conn, $category);
            echo json_encode($data, JSON_PRETTY_PRINT);
            //print_r($arr);
            break;
        case '/api/search/' .substr($request, 12, strlen($request) ):
            $searchTerm = substr($request, 12, strlen($request));
            $searchTerm = preg_replace("/_/", " ", $searchTerm);
            $data = getProductsBySearchTerm($conn, $searchTerm);

            echo json_encode($data, JSON_PRETTY_PRINT);
            break;
        default:
            require __DIR__ . '/views/404.php';
            break;
    }

?>

