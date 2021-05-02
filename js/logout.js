function logout() {
    var cart = localStorage.getItem('arrCart');
    $.post('../Database/Logout.php', { 'cart': cart }, function(data) {});
}