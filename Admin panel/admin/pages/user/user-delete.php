<?php
$id = (int) $_GET['id'] ?? 0;
$user = $user->where('id','=',$id)->delete();

if($user){ ?>
<script>
    window.location.href = "http://cargosoft.test/template/templatesaa/app.php?page=user";
</script>
<?php 
}
?>

