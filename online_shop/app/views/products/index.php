<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


    <?php require './app/includes/nav.php' ?>

    <div class="contents">

        <div class="container-fluid my-3">

            <?php
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                $messageType = $_SESSION['message_type']; // Optional: For styling

                echo "<div class='alert alert-{$messageType} alert-dismissible fade show' role='alert'>
  <strong>{$messageType}</strong> {$message}
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>

            <div class="d-flex justify-content-between align-items-center">
                <h3>Products</h3>
                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>

                <div>
                    <button class="btn btn-success btn-lg create_user">Create product</button>
                </div>
                <?php endif; ?>

            </div>

        </div>

        <div class="container-fluid">

            <table class="table  table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= $product["id"] ?></td>
                            <td><?= $product["name"] ?></td>
                            <td><?= $product["price"] ?></td>
                            <td><?= $product["category"] ?></td>
                            <td>
                                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>

                                    <div class="d-flex gap-3">
                                        <form action="/online_shop/products/<?= $product["id"] ?>/delete" method="post" id="em-<?= $product['id'] ?>">
                                            <a class="btn btn-danger" onclick="if(confirm('are you sure you want to delete this product?'))
                                        { document.getElementById('em-<?= $product['id'] ?>').submit() }">Delete</a>
                                        </form>
                                        <button class="btn btn-primary update_btn"
                                            data-id="<?= $product["id"] ?>"
                                            data-price="<?= $product["price"] ?>"
                                            data-name="<?= $product["name"] ?>"
                                            data-category="<?= $product["category"] ?>">Update</button>
                                    </div>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="myForm" action="/online_shop/products">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category:</label>
                                <select name="category" id="category" class="form-control">
                                    <option disabled selected>select category...</option>
                                    <option value="Transport">Transport</option>
                                    <option value="Gadgets">Gadgets</option>
                                    <option value="Sneakers">Sneakers</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Phones">Phones</option>
                                </select>
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Name:</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Price:</label>
                                <input type="text" name="price" class="form-control" id="price">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn_submit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        $('.create_user').click(function(e) {
            e.preventDefault();
            $('#exampleModal').modal('show')
        })

        $('.btn_submit').click(function(e) {
            e.preventDefault();
            $('form').submit();
        })

        $(document).on('click', '.update_btn', function(e) {
            e.preventDefault();
            document.getElementById('myForm').action = `/online_shop/products/` + $(this).data('id') + `/update`;
            $('#exampleModal').modal('show')
            document.getElementById('name').value = $(this).data('name')
            document.getElementById('price').value = $(this).data('price')
            document.getElementById('category').value = $(this).data('category')
        })
    </script>
</body>

</html>