<?php
$id = (int) $_GET['id'] ?? 0;
$user = $user->where('id','=',$id)->delete();

if($user){ ?>
<script>
    window.location.href = "http://localhost/Admin%20panel/?page=user";
</script>
<?php 
}
?>

