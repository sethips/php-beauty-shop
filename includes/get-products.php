<?php require_once "includes/base64_to_img.php"; ?>
<?php include_once "includes/console-log.php"; ?>

<?php
    function getProducts($conn) {
        $query = "SELECT * FROM products ORDER BY `products`.`category` ASC";
        $result = $conn->query($query);
        $i = 0;
        $data = array();
        while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $imageBase64 = $row["image"];
            $imageName = preg_replace("/ /", "_", strtolower($name) ) .".png";
            $image = base64_to_img( $imageBase64, "./assets/images/" .$imageName );
            $price = $row["price"] ." €";
            $priceDiscounted = floatval($price) - (floatval($price) * $row["discounted"]) ." €";
            $productUrl = urlencode(preg_replace('/\s+/', '_', $name));
            //$productUrl = preg_replace('/\s+/', '_', $name);
            $category = $row["category"];
            //calculate discounted price here
            
            $data[$i]["name"] = $name;
            $data[$i]["price"] = $price;
            $data[$i]["priceDiscounted"] = $priceDiscounted;
            $data[$i]["productUrl"] = $productUrl;
            $data[$i]["image"] = $image;
            $data[$i]["category"] = $category;
            
            $i++;
        }
        return($data);
    }

?>