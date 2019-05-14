<?php require_once "includes/render-items-in-category.php"; ?>

<div class="nav-padding"></div>

<?php require_once "includes/navlinks.php"; ?>

<div class="notification notification--add-item content" style="visibility: hidden; position: absolute;">
    <span data-js="notification-add-item-text">Product has been added to the basket.</span>
    <a href="basket"><button class="button notification__button">View Basket</button></a>
</div>
<div class="product-page__container content">
    
    <?php
        require_once "./includes/base64_to_img.php";
        require_once "./includes/db.php";

        $isValid = false;
        parse_str($_SERVER["QUERY_STRING"], $query_array);
        $productName = $query_array["name"];
        //$productName = $_SERVER["QUERY_STRING"];
        
        
        if (preg_match("/[a-zA-Z0-9_+()]$/", $productName)) $isValid = true;
        if($isValid) {
            $productName = preg_replace("/_/", " ", $productName);
            $query = "SELECT * FROM products WHERE name LIKE '%$productName%'";
            $result = $conn->query($query) or die($conn->error);
            $row = $result->fetch_assoc();
            $name = $row["name"];
            $imageBase64 = $row["image"];
            $imageName = preg_replace("/ /", "_", $productName) .".png";
            $image = base64_to_img( $imageBase64, "./assets/images/" .$imageName );
            $price = $row["price"] ." €";
            $description = $row["description"];
            $productUrl = strtolower(preg_replace('/\s+/', '_', $name));
            //calculate discounted price here

            echo "<img class='product-container__img' src='$image'></img>";

            echo "<div class='product-container__details'>
                    <h3 class='product-container__name header--medium'>$name</h3>
                    <div>
                        <span class='product-container__price'>$price</span>
                    </div>
                    <button value='$name' class='product-container__button button button--cart'>Add to Basket</button>
                    <div class='product-container-details__delivery-details'>
                        <p><i class='fas fa-check'></i>Free delivery for orders over 40 €</p>
                        <p><i class='fas fa-check'></i>Fast delivery guaranteed</p>
                    </div>
                    <div class='product-container__description'>
                        <h3 class='header--small'>Description</h3>
                        <p class='product-container-description__text'>
                            $description
                        </p>
                    </div>
                </div>";
            
            
                
        } else {
            echo "Product doesn't exist";
        }
    ?>
</div>
<h3 class="header header--small content offers__header">Have you tried these products?</h3>

<section class="offers content">
    <div class="offers__item-container">
        <?php
            renderItemsInCategory($conn, "wellness");
        ?>
    </div>
</section>

<script>
    const buttonCart = document.querySelector(".button--cart");
    const notification = document.querySelector(".notification--add-item");
    const notificationText = document.querySelector("[data-js=notification-add-item-text]");
    buttonCart.addEventListener("click", (e) => {
        let cartItems = [];
        if(localStorage.shoppingCart) {
            cartItems = localStorage.shoppingCart.split(",");
        }
        cartItems.push(e.target.getAttribute("value"));
        localStorage.shoppingCart = cartItems;
        notification.style.position = "relative";
        notification.style.visibility = "visible";
        notificationText.textContent = '"' + e.target.getAttribute("value") + '"'
        + " has been added to the shopping basket.";
    })
</script>
