<?php include_once "includes/db.php"; ?>
<?php include_once "includes/console-log.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel='stylesheet' href='/lib/glider.min.css'>
    <link rel='stylesheet' href='/css/main.css'>
    <script src='/lib/glider.js'></script>
    
</head>
<body>
    <header>
        <nav class="content">
            <a class="nav__logo" href="/"><img src="/assets/images/logo-olay.svg" alt=""></a>
            <ul>
                <li>
                    <a class="nav__link" href="shop">Shop</a>
                    <ul class="dropdown">
                        <div class="content">
                            <h4 class="dropdown__category-header header--small">Categories</h4>
                            <li value="skin care" class="nav__link" data-js="category-link-nav">Skin care</li>
                            <li value="sun tan lotion" class="nav__link" data-js="category-link-nav">Sun Tan Lotions</li>
                            <li value="makep" class="nav__link" data-js="category-link-nav">Makeup</li>
                            <li value="wellness" class="nav__link" data-js="category-link-nav">Wellness</li>
                            <div class="searchbar nav__searchbar">
                                <input class="searchbar__input searchbar__input--wide" data-js="shop-search-input-nav" type="text" placeholder="Search by category or name">
                                <button class="searchbar__button searchbar__button--wide button" data-js="shop-search-button-nav">Search</button>
                            </div>
                        </div>
                        
                    </ul>
                </li>
                <li><a class="nav__link" href="/skin-care">How-To</a></li>
                <li><a class="nav__link" href="about">About Us</a></li>
            </ul>
            <a href="/basket" class="shopping-basket-link">
                <i class="fas fa-shopping-cart"></i><span class="shopping-basket-link__text nav__link">Shopping Basket</span> 
            </a>
            <button class="nav__hamburger"><i class="fas fa-bars"></i></button>
            <!-- <div class="searchbar">
                <input class="searchbar__input" type="text" placeholder="Search">
                <button class="searchbar__button button">Go!</button>
            </div> -->
            
            
        </nav>
    </header>

    <script>
        //navbar search shop
        let shopSearchBtnNav = document.querySelector("[data-js=shop-search-button-nav]");
        let shopSearchInputNav = document.querySelector("[data-js=shop-search-input-nav]");
        let categoryLinksNav = [].slice.call(document.querySelectorAll("[data-js=category-link-nav]"));

        for(let i=0; i<categoryLinksNav.length; i++) {
            categoryLinksNav[i].addEventListener("click", (e) => {
                let searchTerm = e.target.getAttribute("value");
                localStorage.setItem("navCategorySearchTerm", searchTerm);
                window.location = "shop";
            })
        }

        shopSearchBtnNav.addEventListener("click", (e) => {
            let searchTerm = shopSearchInputNav.value;

            if (searchTerm !== "") {
                localStorage.setItem("navSearchTerm", searchTerm);
                window.location = "shop";
            }
            else {
                console.log("Please provide a search term");
            }
        })
    </script>
