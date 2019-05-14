let hasSearched = false;
let searchTerm = "";

window.addEventListener("load", () => {
    let request = new XMLHttpRequest();
    request.addEventListener("load", reqListener);
    if (localStorage.navCategorySearchTerm) {
        searchTerm = localStorage.navCategorySearchTerm.replace(/ /g, "_");
        request.open('GET', '/api/category/' + searchTerm, true);
        localStorage.removeItem("navCategorySearchTerm");
    }
    else if (localStorage.navSearchTerm) {
        hasSearched = true;
        searchTerm = localStorage.navSearchTerm.replace(/ /g, "_");
        request.open('GET', '/api/search/' + searchTerm, true);
        localStorage.removeItem("navSearchTerm");
    }
    else {
        request.open('GET', '/api/products', true);
    }
    request.send(null);
})
let shopSearchBtn = document.querySelector("[data-js=shop-search-button]");
let shopSearchInput = document.querySelector("[data-js=shop-search-input]");
shopSearchBtn.addEventListener("click", (e) => {
    searchTerm = shopSearchInput.value;
    if (searchTerm !== "") {
        hasSearched = true;
        searchTerm = searchTerm.replace(/ /g, "_");
        let request = new XMLHttpRequest();
        request.addEventListener("load", reqListener);
        request.open('GET', '/api/search/' + searchTerm, true);
        request.send(null);
    }
    else {
        console.log("Please provide a search term");
    }
})

let sidebarLinks = document.querySelectorAll(".sidebar__link");
sidebarLinks.forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        let request = new XMLHttpRequest();
        request.addEventListener("load", reqListener);

        let category = e.target.getAttribute("value");
        if (category !== "") {
            category = category.replace(/ /g, "_");
            request.open('GET', '/api/category/' + category, true);
        }
        else {
            request.open('GET', '/api/products', true);

        }
        request.send(null);

    })
})

function reqListener() {
    let productContainers = [];
    let shopItems = document.querySelector(".shop__items");
    while (shopItems.firstChild) {
        shopItems.removeChild(shopItems.firstChild);
    }
    const resJson = JSON.parse(this.response);
    if (hasSearched) {
        let searchResultsHeader = document.createElement("h3");
        searchResultsHeader.classList = "header--large";
        searchResultsHeader.textContent = "Found " + resJson.length
            + " products with search term: " + searchTerm.replace(/_/g, " ");
        shopItems.appendChild(searchResultsHeader);
    }

    let categories = [];
    let categoryIndex = 0;
    resJson.forEach(prod => {
        let productElem = document.createElement("div");
        productElem.classList = "product";
        let linkElem = document.createElement("a");
        linkElem.href = "product?name=" + prod.productUrl;
        let nameElem = document.createElement("figcaption");
        nameElem.textContent = prod.name;
        nameElem.classList = "product__name";
        let priceElem = document.createElement("span");
        priceElem.textContent = prod.price;
        priceElem.classList = "product__price";
        let priceElemDiscount = document.createElement("span");
        priceElemDiscount.textContent = prod.priceDiscounted;
        priceElemDiscount.classList = "product__price-discounted";
        let imgElem = document.createElement("img");
        imgElem.src = prod.image;
        imgElem.classList = "product__img";

        productElem.appendChild(imgElem);
        productElem.appendChild(nameElem);
        let priceContainer = document.createElement("figcaption");
        priceContainer.appendChild(priceElem);
        priceContainer.appendChild(priceElemDiscount);
        productElem.appendChild(priceContainer);
        linkElem.appendChild(productElem);

        //create category headers
        if (!categories.includes(prod.category)) {
            categories.push(prod.category);
            categoryHeaderElem = document.createElement("h2");
            categoryHeaderElem.classList = "shop__category-header header--medium";
            categoryHeaderElem.textContent = prod.category;
            if (!hasSearched) shopItems.appendChild(categoryHeaderElem);
            //shopItems.appendChild(categoryHeaderElem);
            let productContainer = document.createElement("div");
            productContainer.classList = "product-container";
            productContainers.push(productContainer);
            categoryIndex++;
        }

        productContainers[categoryIndex - 1].appendChild(linkElem);
        shopItems.appendChild(productContainers[categoryIndex - 1]);
    })
    hasSearched = false;
}


