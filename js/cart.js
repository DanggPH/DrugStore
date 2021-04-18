function updateCart(){
	document.getElementsByClassName('cart_no')[0].innerHTML=document.getElementsByClassName('cart-item').length
}
function updatePrice(){
	var total = 0;
	for (var i = 0; i < document.getElementsByClassName('cart-item').length; i++) {
	 	total += parseInt(document.getElementsByClassName('cart-item')[i].children[2].children[0].innerHTML);
	}
	document.getElementById("total-price").innerHTML=total
}
function myFunction(item, index, arr) {
  console.log(item)
}