<?php require_once "includes/base64_to_img.php"; ?>
<?php require_once "includes/get-products.php"; ?>
<?php require_once "includes/render-items-in-category.php"; ?>

<div class="hero">
    <div class="glider-contain">
        <div class="glider">

            <figure class="glider__item glider__item--skin">
                <div class="hero-banner__container">
                    <button value="skin care" data-js="category-button-hero" class="button hero__button hero__button--skin">Shop Now »</button>
                </div>
                
                <img class="hero-banner__img" src="./assets/images/skin_banner2.png" alt="">
            </figure>

            <figure class="glider__item glider__item--makeup">
                <div class="hero-banner__container">
                    <button value="makeup" data-js="category-button-hero" class="button hero__button hero__button--makeup">Shop Now »</button>
                </div>
                
                <img class="hero-banner__img" src="./assets/images/makeup_banner2.png" alt="">
            </figure>

            <figure class="glider__item glider__item--sun">
                <div class="hero-banner__container">
                    <button value="sun tan lotion" data-js="category-button-hero" class="button hero__button hero__button--sun">Shop Now »</button>
                </div>
                
                <img class="hero-banner__img" src="./assets/images/sun_banner2.png" alt="">
            </figure>

            
        </div>

        <div id=dots>
            <div class="glider-dots" role="tablist"></div>
        </div>
    </div>
</div>

<script>
    let categoryButtonsHero = [].slice.call(document.querySelectorAll("[data-js=category-button-hero]"));

    for(let i=0; i<categoryButtonsHero.length; i++) {
        categoryButtonsHero[i].addEventListener("click", (e) => {
            let searchTerm = e.target.getAttribute("value");
            localStorage.setItem("navCategorySearchTerm", searchTerm);
            window.location = "shop";
        })
    }
    
    const gliderItems = document.querySelectorAll(".glider figure");
    const glider = new Glider(document.querySelector('.glider'), {
        slidesToShow: 1,
        dots: '#dots',
        draggable: true,
        rewind: true,
        scrollLock: true,
        scrollLockDelay: 100,
        duration: 1
    });
    
    let gliderIndex = 0;
    setInterval(() =>  {
        glider.scrollItem(gliderIndex, false);
        gliderIndex = (gliderIndex === gliderItems.length-1) ? 0 : gliderIndex+1; 
        
    }, 4000)
</script>

<h3 class="header header--small content offers__header">Ready for the sun - All sun tan lotions up to -15%</h3>

<section class="offers content">
    <div class="offers__item-container">
        <?php
            renderItemsInCategory($conn, "sun tan lotion");
        ?>
    </div>
</section>

<div class="banner-ad-container--small content">
    <img class="banner-ad__img-small" src="./assets/images/sun_banner_small_w_btn.png" alt="">
    <img class="banner-ad__img-small" src="./assets/images/makeup_banner_small_w_btn.png" alt="">
    <img class="banner-ad__img-small" src="./assets/images/skin_banner_small_w_btn.png" alt="">
</div>

<div class="banner-ad-container--wide content">
    <img class="banner-ad__img-wide" src="./assets/images/makeup_banner_w_btn.png" alt="">
    <img class="banner-ad__img-small" src="./assets/images/makeup_banner_small_w_btn.png" alt="">
</div>

<section class="offers content">
    <div class="offers__item-container">
        <?php
            renderItemsInCategory($conn, "makeup");
        ?>
    </div>
</section>

<div class="content">
    <div class="newsletter">
        <div class="newsletter__header-container">
            <h2>Subscribe to our Newsletter</h2>
        </div>
        
        <div class="newsletter__form-container">
            <p class="newsletter__text">Get the latest deals and more by subscribing to our monthly newsletter</p>
            
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div>
                    <input class="newsletter__input" type="text" name="email" placeholder="Enter your e-mail">
                    <button class="button newsletter__button" type="submit" value="submit">Subscribe »</button>
                </div>
                
            </form>
        </div>
        
    </div>
    
</div>
