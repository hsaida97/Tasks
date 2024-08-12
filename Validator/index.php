<?php

require_once 'validator.php';
$validator = null;

if (isset($_POST) and count($_POST) > 0) {
    $data = $_POST;
    $rules = [
        'name' => ['required', 'min:5', 'max:50'],
        'surname' => ['required', 'min:5', 'max:10'],
        'age' => ['required', 'integer'],
        'email' => ['required', 'email', 'unique:users,email'],
        'username' => ['required', 'exists:users,username'],
        'gender' => ['required', 'in:1,2'],
    ];

    Validator::make($data, $rules);
    $validator = new Validator();
    if ($validator->fails()) {
        print_r($validator->errors());
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</head>
<style>
    form {
        margin-top: 3rem;
        width: 50%;
    }
</style>

<body>
    <div class="container">
        <form method="post" action="">
            <div class="form-group mt-5">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="" name="name" aria-describedby="name">
                <?php if (isset($validator) and $validator->fails() and @isset($validator->errors()['name'])) { ?>
                    <small id="emailHelp" class="form-text text-muted"><?php echo $validator->errors()['name'] ?></small>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="surname">Last Name</label>
                <input type="text" class="form-control" id="surname" name="surname" aria-describedby="surname">
                <?php if (isset($validator) and $validator->fails() and @isset($validator->errors()['surname'])) { ?>
                    <small id="emailHelp" class="form-text text-muted"><?php echo $validator->errors()['surname'] ?></small>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
                <?php if (isset($validator) and $validator->fails() and @isset($validator->errors()['username'])) { ?>
                    <small id="emailHelp"
                        class="form-text text-muted"><?php echo $validator->errors()['username'] ?></small>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="email">
                <?php if (isset($validator) and $validator->fails() and @isset($validator->errors()['email'])) { ?>
                    <small id="emailHelp" class="form-text text-muted"><?php echo $validator->errors()['email'] ?></small>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email Confirmation</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email_confirmed"
                    aria-describedby="email">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" aria-describedby="age">
                <?php if (isset($validator) and $validator->fails() and @isset($validator->errors()['age'])) { ?>
                    <small id="emailHelp" class="form-text text-muted"><?php echo $validator->errors()['age'] ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <label for="gender">Select Gender:</label>
            <select id="gender" name="gender">
                <option value="">Select</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
            <?php if (isset($validator) and $validator->fails() and @isset($validator->errors()['gender'])) { ?>
                <small id="emailHelp" class="form-text text-muted"><?php echo $validator->errors()['gender'] ?></small>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>