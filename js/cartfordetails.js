function updateCart() {
    document.getElementsByClassName('cart_no')[0].innerHTML = document.getElementsByClassName('cart-item').length
    var temp = document.getElementById("marker");
    document.getElementById("cart-list").appendChild(temp);
    localStorage.setItem("cart", document.getElementById("cart-list").innerHTML);
    var arrCart = new Array();
    var x = document.getElementsByClassName('cart-item');
    for (var i = 0; i < x.length; i++) {
        arrCart[i] = {
            name: x[i].children[1].children[0].textContent,
            price: x[i].children[2].children[0].textContent,
            quality: x[i].children[1].children[1].children[0].textContent,
            image: x[i].children[0].children[0].getAttribute("src"),

        };
    }
    localStorage.setItem("arrCart", JSON.stringify(arrCart));
}

function updatePrice() {
    var total = 0;
    var x = document.getElementsByClassName('cart-item');
    for (var i = 0; i < x.length; i++) {
        total += parseInt(x[i].children[2].children[0].textContent) * parseInt(x[i].children[1].children[1].children[0].textContent);
    }
    document.getElementById("total-price").textContent = total
}

function addToCart(item) {
    var x = document.getElementsByClassName('cart-item');
    for (var i = 0; i < x.length; i++) {
        if (item.parentElement.parentElement.parentElement.children[0].textContent === x[i].children[1].children[0].textContent) {
            x[i].children[1].children[1].children[0].textContent = parseInt(x[i].children[1].children[1].children[0].textContent) + parseInt(document.getElementById("quality").options[document.getElementById("quality").selectedIndex].value);
            return;
        }
    }
    var liClass = document.createElement("li");
    var DivContainer = document.createElement("div");

    DivContainer.setAttribute("class", "cart-item");

    var imageContainer = document.createElement("div");
    imageContainer.setAttribute("class", "image");
    var image = document.createElement("img");
    image.setAttribute("src", item.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].getAttribute("src"));

    var descripsion = document.createElement("div");
    descripsion.setAttribute("class", "item-description");

    var dis = document.createElement("p");
    dis.setAttribute("class", "name");
    dis.innerHTML = item.parentElement.parentElement.parentElement.children[0].textContent;
    var dos = document.createElement("p");
    dos.innerHTML = "Quantity: ";
    var dus = document.createElement("span");
    dus.setAttribute("class", "light-red");
    dus.innerHTML = document.getElementById("quality").options[document.getElementById("quality").selectedIndex].value;
    dos.appendChild(dus);

    descripsion.appendChild(dis)
    descripsion.appendChild(dos);

    var right = document.createElement("div");
    right.setAttribute("class", "right");
    var das = document.createElement("p");
    das.setAttribute("class", "price");
    das.innerHTML = item.parentElement.parentElement.parentElement.children[5].children[0].innerHTML;
    var ref = document.createElement("a");
    ref.setAttribute("onMouseOver", "this.style.cursor='pointer'")
    ref.setAttribute("class", "remove");
    ref.setAttribute("onclick", "this.parentElement.parentElement.parentElement.remove();updateCart()");
    var aimg = document.createElement("img");
    aimg.setAttribute("src", "images/remove.png");
    aimg.setAttribute("alt", "remove");
    ref.appendChild(aimg);
    right.appendChild(das);
    right.appendChild(ref);

    imageContainer.appendChild(image);
    DivContainer.appendChild(imageContainer);
    DivContainer.appendChild(descripsion);
    DivContainer.appendChild(right);
    liClass.appendChild(DivContainer);
    document.getElementById("cart-list").appendChild(liClass);
}

function loginWindow() {
    login = window.open("login1.html", "login", "width=600,height=800");
}
setInterval(function() {
    if (localStorage.getItem("cart") == null) {
        return;
    }
    document.getElementById("cart-list").innerHTML = localStorage.getItem("cart");
    updateCart();
    updatePrice();
}, 500);