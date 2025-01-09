<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>

<body>


    <?php require './app/includes/nav.php' ?>

    <div class="contents">

        <div class="container-fluid my-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Users</h3>
                <div>
                    <button class="btn btn-success btn-lg create_user">Create user</button>
                </div>

            </div>

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

            <table class="table  table-hover">
                <thead>
                    <tr>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Mail</th>
                        <th scope="col">role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user["first_name"] ?></td>
                            <td><?= $user["last_name"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["role_id"] == 1 ? 'admin' : 'user' ?></td>

                            <td>

                                <?php if ($_SESSION['user_id'] !== $user['id']) { ?>
                                    <div class="d-flex gap-3">
                                        <form action="/online_shop/users/<?= $user["id"] ?>/delete" method="post" id="em-<?= $user['id'] ?>">
                                            <a class="btn btn-danger" onclick="if(confirm('are you sure you want to delete this user?'))
                                        { document.getElementById('em-<?= $user['id'] ?>').submit() }">Delete</a>
                                        </form>
                                        <button class="btn btn-primary update_btn"
                                            data-id="<?= $user["id"] ?>"
                                            data-role-id="<?= $user["role_id"] ?>"
                                            
                                            data-first-name="<?= $user["first_name"] ?>"
                                            data-last-name="<?= $user["last_name"] ?>"
                                            data-email="<?= $user["email"] ?>">Update</button>
                                    </div>


                                <?php } else { ?>
                                    <div class="alert alert-primary" role="alert">
                                        it's you
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="myForm" action="/online_shop/users">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">first name:</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">last name:</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">default password:</label>
                                    <input type="text" name="password" class="form-control" value="password" id="password" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">email:</label>
                                    <input type="email" name="email" class="form-control" id="email" required disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">role_id:</label>
                                    <select name="role_id" class="form-control" id="role_id">
                                        <option selected value="null" disabled>select role...</option>
                                        <option value="1">admin</option>
                                        <option value="2">user</option>
                                    </select>
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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

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
            console.log($(this).data('id'), 'ID');
            console.log($(this).data('role-id'), 'role-id');
            
            document.getElementById('myForm').action = `/online_shop/users/` + $(this).data('id') + `/update`;
            $('#exampleModal').modal('show')
            document.getElementById('first_name').value = $(this).data('first-name')
            document.getElementById('last_name').value = $(this).data('last-name')
            document.getElementById('email').value = $(this).data('email')
            document.getElementById('role_id').value = $(this).data('role-id')
            
        })
    </script>
</body>

</html>