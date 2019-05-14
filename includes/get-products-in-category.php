<?php require_once "includes/base64_to_img.php"; ?>

<?php
    function getProductsInCategory($conn, $category) {
        $query = "SELECT * FROM products WHERE category = '$category'";
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