// script.js
document.getElementById('product-form').addEventListener('submit', function(event) {
    event.preventDefault();

    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var imageUrl = document.getElementById('image-url').value;

    var product = {
        name: name,
        description: description,
        imageUrl: imageUrl
    };

    // Send AJAX request to the PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_product.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Refresh the product table
            getProducts();
        }
    };
    xhr.send(JSON.stringify(product));

    // Clear the form fields
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('image-url').value = '';
});

function deleteProduct(id) {
    // Send AJAX request to the PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'del_product.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Refresh the product table
            getProducts();
        }
    };
    xhr.send(JSON.stringify({ id: id }));
}

function getProducts() {
    // Send AJAX request to the PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_product.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var products = JSON.parse(xhr.responseText);
            displayProducts(products);
        }
    };
    xhr.send();
}

function displayProducts(products) {
    var tableBody = document.querySelector('#product-table tbody');
    tableBody.innerHTML = '';

    for (var i = 0; i < products.length; i++) {
        var row = document.createElement('tr');
        var nameCell = document.createElement('td');
        var descriptionCell = document.createElement('td');
        var imageCell = document.createElement('td');
        var actionCell = document.createElement('td');
        var deleteButton = document.createElement('button');

        nameCell.textContent = products[i].name;
        descriptionCell.textContent = products[i].description;
        imageCell.innerHTML = '<img src="' + products[i].imageUrl + '" alt="' + products[i].name + '" width="100">';
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', deleteProduct.bind(null, products[i].id));

        actionCell.appendChild(deleteButton);
        row.appendChild(nameCell);
        row.appendChild(descriptionCell);
        row.appendChild(imageCell);
        row.appendChild(actionCell);
        tableBody.appendChild(row);
    }
}

// Fetch and display the products on page load
window.addEventListener('load', function() {
    getProducts();
});
