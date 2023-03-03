function add_to_cart(id, name) {

    let names = JSON.parse(localStorage.getItem('items'));
    if (names === null) {
        names = [];
    }
    let entry = {
        id,
        name
    }
    names.push(entry);
    localStorage.setItem('items', JSON.stringify(names));
    let cartData = document.getElementById("cartData");
    cartData.innerHTML = "";
    for(let name of names){
        cartData.innerHTML += `<li>${name.name}</li>`
    }
}

function confirmSubmit(event, message = "Are you sure you want to delete product the form?") {
    event.preventDefault();
    return confirm(message);
}

function clearCart() {
    localStorage.clear();
    let cartData = document.getElementById("cartData");
    cartData.innerHTML = 'Empty Cart!';
}

function showCart() {
    let names = JSON.parse(localStorage.getItem('items'));
    alert(JSON.stringify(names));
}

function sendOrder() {
    console.log(localStorage.getItem('items'))
    $.ajax({
        url: '/order',
        method: 'POST',
        data: { order: localStorage.getItem('items') },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    alert("Order created!")
    localStorage.setItem('items', "[]");
}

function search() {
    let txtValue;
    let i;
    let input = document.getElementById("search");
    let filter = input.value.toLowerCase();
    let tbody = document.getElementById("products");
    let tr = tbody.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        txtValue = tr[i].id;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
window.addEventListener("load", (event) => {
    let names = JSON.parse(localStorage.getItem('items'));
    let cartData = document.getElementById("cartData");
    cartData.innerHTML = "";
    for(let name of names){
        cartData.innerHTML += `<li>${name.name}</li>`
    }
});
