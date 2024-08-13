<?php

require_once 'validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $rules = [
        'name' => ['required', 'min:5', 'max:50'],
        'surname' => ['required', 'min:5', 'max:10'],
        'age' => ['required', 'integer'],
        'email' => ['required', 'email', 'unique:users,email', 'confirm'],
        'email_confirm' => ['required', 'email'],
        'username' => ['required', 'exists:users,username'],
        'gender' => ['required', 'in:1,2'],
    ];

    Validator::make($data, $rules);
    $validator = new Validator();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Form</title>
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
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['name'])) { ?>
                    <?php foreach ($validator->errors()['name'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="surname">Last Name</label>
                <input type="text" class="form-control" id="surname" name="surname" aria-describedby="surname">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['surname'])) { ?>
                    <?php foreach ($validator->errors()['surname'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['username'])) { ?>
                    <?php foreach ($validator->errors()['username'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="email">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['email'])) { ?>
                    <?php foreach ($validator->errors()['email'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="email_confirm">Email Confirmation</label>
                <input type="text" class="form-control" id="email_confirm" name="email_confirm"
                    aria-describedby="email_confirm">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['email_confirm'])) { ?>
                    <?php foreach ($validator->errors()['email_confirm'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" aria-describedby="age">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['age'])) { ?>
                    <?php foreach ($validator->errors()['age'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="form-group">
                <label for="gender">Select Gender:</label>
                <select id="gender" name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['gender'])) { ?>
                    <?php foreach ($validator->errors()['gender'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>