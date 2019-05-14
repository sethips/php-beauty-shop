<?php
    function renderItemsInCategory($conn, $category) {
        $products = getProductsInCategory($conn, $category);
        $i = 0;
        foreach($products as $product) {
            
            $url = $product["productUrl"];
            $name = $product["name"];
            $price = $product["price"];
            $priceDiscounted = $product["priceDiscounted"];
            $image = $product["image"];
            if($i < 6) echo "<a href='./product?name=$url'><div class='offers__product'>
                <img class='product__img' src=$image></img>
                <figcaption class='product__name'>$name</figcaption>
                <figcaption>
                    <span class='product__price'>$price</span>
                    <span class='product__price-discounted'>$priceDiscounted</span>
                </figcaption>
                
                </div></a>";
            $i++;
        }
    }
?>