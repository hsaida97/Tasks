<?php

require_once 'validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $rules = [
        'name' => ['required', 'min:5', 'max:50'],
        'surname' => ['required', 'min:5', 'max:10'],
        'age' => ['required', 'integer'],
        'email' => ['required', 'email', 'unique:users,email', 'confirm'],
        'email_confirm' => ['required'],
        'username' => ['required', 'exists:users,username'],
        'password' => ['required', 'min:8', 'confirm'],
        'password_confirm' => ['required'],
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
                <input type="text" class="form-control" id="name"
                    value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : ''; ?>"
                    name="name" aria-describedby="name">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['name'])) { ?>
                    <?php foreach ($validator->errors()['name'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="surname">Last Name</label>
                <input type="text" class="form-control" id="surname" name="surname"
                    value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname'], ENT_QUOTES) : ''; ?>"
                    aria-describedby="surname">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['surname'])) { ?>
                    <?php foreach ($validator->errors()['surname'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : ''; ?>"
                    aria-describedby="username">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['username'])) { ?>
                    <?php foreach ($validator->errors()['username'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>"
                    aria-describedby="email">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['email'])) { ?>
                    <?php foreach ($validator->errors()['email'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="email_confirm">Email Confirmation</label>
                <input type="text" class="form-control" id="email_confirm"
                    value="<?php echo isset($_POST['email_confirm']) ? htmlspecialchars($_POST['email_confirm'], ENT_QUOTES) : ''; ?>"
                    name="email_confirm" aria-describedby="email_confirm">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['email_confirm'])) { ?>
                    <?php foreach ($validator->errors()['email_confirm'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age"
                    value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age'], ENT_QUOTES) : ''; ?>"
                    aria-describedby="age">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['age'])) { ?>
                    <?php foreach ($validator->errors()['age'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if (isset($validator) && $validator->fails() && isset($validator->errors()['password'])) { ?>
                    <?php foreach ($validator->errors()['password'] as $error) { ?>
                        <small class="form-text text-muted"><?php echo $error; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password_confirm">Password Confirm</label>
                <input type="password_confirm" class="form-control" id="password_confirm" name="password_confirm">
                <?php if (isset($validator->errors()['password_confirm'])): ?>
                    <small id="passwordConfirmHelp"
                        class="form-text text-muted"><?= $validator->errors()['password_confirm'][0]; ?></small>
                <?php endif; ?>
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