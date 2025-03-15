<?php 
    require 'partials/head.php';
    require 'partials/navigation.php';
?>

<div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>$10.00</td>
                    <td><input type="number" class="form-control" value="1" min="1"></td>
                    <td>$10.00</td>
                    <td><button class="btn btn-danger">Remove</button></td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>$20.00</td>
                    <td><input type="number" class="form-control" value="1" min="1"></td>
                    <td>$20.00</td>
                    <td><button class="btn btn-danger">Remove</button></td>
                </tr>
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total: $30.00</h4>
            <button class="btn btn-success">Proceed to Checkout</button>
        </div>
    </div>