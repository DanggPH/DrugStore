function updateCart(){
	document.getElementsByClassName('cart_no')[0].innerHTML=document.getElementsByClassName('cart-item').length
	var temp = document.getElementById("marker");
	document.getElementById("cart-list").appendChild(temp);
}
function updatePrice(){
	var total = 0;
	for (var i = 0; i < document.getElementsByClassName('cart-item').length; i++) {
	 	total += parseInt(document.getElementsByClassName('cart-item')[i].children[2].children[0].innerHTML);
	}
	document.getElementById("total-price").innerHTML=total
}
function addToCart(item){
	var liClass = document.createElement("li");
	var DivContainer = document.createElement("div");

	DivContainer.setAttribute("class","cart-item");

	var imageContainer = document.createElement("div");
	imageContainer.setAttribute("class","image");
	var image = document.createElement("img");
	image.setAttribute("src",item.parentElement.parentElement.children[0].children[0].children[0].getAttribute("src"));

	var descripsion = document.createElement("div");
	descripsion.setAttribute("class","item-description");

	var dis = document.createElement("p");
	dis.setAttribute("class","name");
	dis.innerHTML="sản phẩm clgt";	
	var dos = document.createElement("p");
	dos.innerHTML="Quantity: ";
	var dus = document.createElement("span");
	dus.setAttribute("class","light-red");
	dus.innerHTML="01";
	dos.appendChild(dus);

	descripsion.appendChild(dis)
	descripsion.appendChild(dos);


	var right = document.createElement("div");
	right.setAttribute("class","right");
	var das = document.createElement("p");
	das.setAttribute("class","price");
	das.innerHTML=item.parentElement.parentElement.children[2].innerHTML;
	var ref = document.createElement("a");
	ref.setAttribute("href","#");
	ref.setAttribute("class","remove");
	ref.setAttribute("onclick","this.parentElement.parentElement.parentElement.remove();");
	var aimg = document.createElement("img");
	aimg.setAttribute("src","images/remove.png");
	aimg.setAttribute("alt","remove");
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