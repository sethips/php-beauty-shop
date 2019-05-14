<?php require_once "includes/base64_to_img.php"; ?>
<?php require_once "includes/get-products-search.php"; ?>

<img class="sale-banner" src="./assets/images/sale_banner_custom.png" alt="">

<?php require_once "includes/navlinks.php"; ?>
<section class="shop content">


<div class='shop__sidebar'>
    <div class="shop__search-container">
        <h3 class="header--medium">Search Products in the Shop</h3>
        <div class="shop__searchbar">
            <input class="searchbar__input" data-js="shop-search-input" type="text" placeholder="Search by category or name">
            <button class="searchbar__button button" data-js="shop-search-button">Search</button>
        </div>
    </div>
    
    <h3>Categories</h3>

    <a value='' class='sidebar__link' href="">All</a>
    <ul class="shop__sub-category-links">
        <li><a value='skin care' class='sidebar__link'>Skin Care</a></li>
        <li><a value='sun tan lotion' class='sidebar__link'>Sun Tan Lotions</a></li>
        <li><a value='makeup' class='sidebar__link'>Makeup</a></li>
        <li><a value='wellness' class='sidebar__link'>Wellness</a></li>
    </ul>

</div>

<div class="shop__items"></div>
<script src="./scripts/search-shop.js"></script>

</section>