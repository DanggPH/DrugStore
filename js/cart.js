function updateCart(){
	document.getElementsByClassName('cart_no')[0].innerHTML=document.getElementsByClassName('cart-item').length
}
function updatePrice(){
	document.getElementsByClassName('cart-item').forEach(myFunction)
}
function myFunction(item, index, arr) {
  console.log(item)
}