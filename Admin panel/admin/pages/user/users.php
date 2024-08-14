<?php

$users = $user->all();

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Responsive Hover Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>EMail</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key =>$userDetail){  $id = $key+1;?>
                                
                                <tr>
                                <td><?=  $id ?></td>
                                <td><?=  $userDetail->name ?></td>
                                <td><?=  $userDetail->email ?></td>
                                <!-- <td><span class="tag tag-success">Approved</span></td> -->
                                <td>
                                    <a href="?page=user&action=edit&id=<?= $userDetail->id ?>"    ><i class="fa-solid fa-pen"></i></a>
                                    <a href="?page=user&action=delete&id=<?= $userDetail->id ?>"    ><i class="fa-solid fa-trash"></i></a>
                            
                            </td>
                            </tr>
                        

                                <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>