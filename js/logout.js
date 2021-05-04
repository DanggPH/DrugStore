function logout() {
    var cart = localStorage.getItem('arrCart');
    $.post('../Database/Logout.php', { 'cart': cart }, function(data) { location.href = '../index.php' });
}

function checkout() {
    var cart = localStorage.getItem('arrCart');
    $.post('../checkout.php', { 'cart': cart }, function(data) { location.href = '../checkout.php' });
}