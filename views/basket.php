<div class="content basket">
    <h3 class="header--medium basket__header">Shopping Basket</h3>
    <p class="f-sm">
        <strong>Now Free Shipping!</strong>  The advantage  applies to all delivery methods except express delivery.
    </p>
    <div class="basket-item basket-container__header">
        <span></span>
        <span class="basket-container-header__product">Product</span>
        <span class="basket-container-header__price">Price</span>
        <span class="basket-container-header__amount">Amount</span>
        <span class="basket-container-header__total">Total</span>
    </div>
    <div class="basket-container">
        
    </div>

</div>
<script>
    let itemIndex = 0;
    let cartItems = [];
    let basketContainer = document.querySelector(".basket-container");
    let basketContainerHeader = document.querySelector(".basket-container__header");
    if(localStorage.shoppingCart) {
        cartItems = localStorage.shoppingCart.split(",");
        populateBasket(cartItems[0]);
    } 
    else {
        basketContainerHeader.style.display = "none";
        basketContainer.textContent = "Your shopping basket is empty.";
    }
    function populateBasket(item) {
        item = item.replace(/ /g, "_");
        let request = new XMLHttpRequest();
        request.addEventListener("load", reqListener);
        request.open('GET', '/api/search/' + item, true);
        request.send(null);
    }
    function getIsItemOnPage(itemName) {
        let itemsOnPage = document.querySelectorAll(".basket-item__link");
        itemsOnPage.forEach(itemOnPage => {
            const itemOnPageName = itemOnPage.textContent;
            if(itemName === itemOnPageName) {
                return true;
            }
            //if(itemOnPageName === itemName) return true;
            
        })
        return false;
    }
    function updateItemsFromLocalStorage() {
        while (basketContainer.firstChild) {
            basketContainer.removeChild(basketContainer.firstChild);
        }
        itemIndex = 0;
        cartItems = [];
        if(localStorage.shoppingCart) {
            cartItems = localStorage.shoppingCart.split(",");
            populateBasket(cartItems[0]);
            basketContainerHeader.style.display = "grid";
        } else {
            basketContainerHeader.style.display = "none";
            basketContainer.textContent = "Your shopping basket is empty.";
        }
    }
    function reqListener() {
        let itemContainer = document.querySelector(".basket-container");

        const resJson = JSON.parse(this.response);
        const prod = resJson[0];

        let indexOfDuplicateItemOnPage = 0;
        let isItemOnPage = false;
        let itemLinksOnPage = document.querySelectorAll(".basket-item__link");
        itemLinksOnPage.forEach((itemLinkOnPage, i) => {
            const itemOnPageName = itemLinkOnPage.textContent;
            if(prod.name === itemOnPageName) {
                isItemOnPage = true;
                indexOfDuplicateItemOnPage = i;
            }
        })

        let itemAmountsOnPage = document.querySelectorAll(".basket-item__amount");
        let itemPricesOnPage = document.querySelectorAll("[data-js=basket-item__price]");
        let itemTotalPricesOnPage = document.querySelectorAll(".basket-item__total");
        if(isItemOnPage) {
            let currAmount = parseFloat(itemAmountsOnPage[indexOfDuplicateItemOnPage].textContent);
            let price = parseFloat(itemPricesOnPage[indexOfDuplicateItemOnPage].textContent);
            currAmount++;
            totalPrice = price * currAmount;
            
            itemAmountsOnPage[indexOfDuplicateItemOnPage].textContent = currAmount.toString();
            itemTotalPricesOnPage[indexOfDuplicateItemOnPage].textContent = totalPrice.toString() + " €";
        }
        else {
            let productElem = document.createElement("div");
            productElem.classList = "basket-item";
            let linkElem = document.createElement("a");
            linkElem.href = "product?name=" + prod.productUrl;
            linkElem.classList = "basket-item__link";
            linkElem.textContent = prod.name;

            let priceElem = document.createElement("span");
            priceElem.setAttribute("data-js", "basket-item__price");
            priceElem.classList = "basket-item__price"; 
            priceElem.textContent = prod.price;
            let imgElem = document.createElement("img");
            imgElem.src = prod.image;
            imgElem.classList = "basket-item__img";

            let removeBtn = document.createElement("button");
            removeBtn.classList = "basket-item__remove-btn";
            removeBtn.textContent = "X";
            removeBtn.addEventListener("click", (e) => {
                let elementName = e.target.parentNode.parentNode.querySelector(".basket-item__link").textContent;
                //cartItems.splice(0, cartItems.indexOf(elementName));
                //console.log(cartItems.indexOf(elementName));
                
                //console.log(cartItems);
                let newCartItems = [];
                cartItems.forEach((cartItem, i) => {
                    if(cartItem !== elementName) {
                        newCartItems.push(cartItem);
                    }
                })
                cartItems = newCartItems;
                localStorage.shoppingCart = cartItems;
                updateItemsFromLocalStorage();
            })

            let amountElem = document.createElement("span");
            amountElem.classList = "basket-item__amount";
            amountElem.textContent = "1";

            let totalElem = document.createElement("span");
            totalElem.classList = "basket-item__total f-bold";
            totalElem.textContent = prod.price;

            let imgAndRemoveBtnElem = document.createElement("div");
            imgAndRemoveBtnElem.classList = "basket-item__img-and-remove";
            imgAndRemoveBtnElem.appendChild(removeBtn);
            imgAndRemoveBtnElem.appendChild(imgElem);

            productElem.appendChild(imgAndRemoveBtnElem);
            productElem.appendChild(linkElem);
            productElem.appendChild(priceElem);
            productElem.appendChild(amountElem);
            productElem.appendChild(totalElem);

            itemContainer.appendChild(productElem);
        }

        itemIndex++;
        if(itemIndex < cartItems.length) {
            populateBasket(cartItems[itemIndex]);
        }
        else {
            getBasketPrice();
        }
    }
    function getBasketPrice() {
        let totalPrice = 0.0;
        const basketItemPrices = document.querySelectorAll("[data-js=basket-item__price]");
        const itemAmountsOnPage = document.querySelectorAll(".basket-item__amount");
        basketItemPrices.forEach((priceElem, i) => {
            const itemAmount = parseFloat(itemAmountsOnPage[i].textContent);
            price = parseFloat(priceElem.textContent.split(" ")[0]) * itemAmount;
            totalPrice += price;
        })
        let totalPriceElem = document.createElement("h4");
        totalPriceElem.textContent = "Total price: " + totalPrice + "€";
        totalPriceElem.classList = "header--small";
        let itemContainer = document.querySelector(".basket-container");
        itemContainer.appendChild(totalPriceElem);
        
    }

</script>