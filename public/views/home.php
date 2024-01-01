<?php include('inc/header.php') ?>
<div class="card">
    <h5 class="card-header">Table Basic</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php foreach ($data as $user):
                    ?>
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong> <?= $user->id ?></strong></td>
                        <td><span class="badge bg-label-primary me-1"> <?= $user->name ?></span></td>
                        <td> <?= $user->email ?></td>
                        <td>
                            <div class="row">
                                <a class="col-2 mx-2" href="/edit/user/<?= $user->id ?>"><i class="bx bx-edit-alt"></i>
                                    Edit</a>
                                <a class="col-1" href="/delete/user/<?= $user->id ?>"><i class="bx bx-trash"></i>
                                    Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('inc/footer.php') ?>