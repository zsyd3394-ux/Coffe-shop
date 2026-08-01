const cartItems = [];
const cartBody = document.getElementById("cart-body");

function addToCart(name, btn) {
    cartItems.push(name);
    updateCart();

    btn.textContent = "Added ✓";
    setTimeout(function() {
        btn.textContent = "Order Now";
    }, 1500);
}

function updateCart() {
    if (cartItems.length === 0) {
        cartBody.innerHTML = "<p>No items added yet.</p>";
        return;
    }

    const counts = {};
    cartItems.forEach(function(item) {
        counts[item] = (counts[item] || 0) + 1;
    });

    let html = "<ul>";
    for (const name in counts) {
        html += "<li>" + name + " × " + counts[name] + "</li>";
    }
    html += "</ul>";

    cartBody.innerHTML = html;
}
function toggleLayout() {
    const row = document.getElementById("coffee-row");
    row.classList.toggle("list-layout");
}