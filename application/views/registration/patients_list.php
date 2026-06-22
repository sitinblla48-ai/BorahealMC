<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="fw-bold">Patient Management</h2>
        <p class="text-muted">Browse, search, add, edit, or delete patient records.</p>
    </div>
    <div class="col-sm-6 text-sm-end">
        <a href="<?php echo base_url('admin/patients_create'); ?>" class="btn btn-primary fw-bold"><i class="fa-solid fa-plus me-1"></i> Add Patient</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm card-stat">
            <div class="card-body">
                <div class="table-responsive p-0 border-0">
                    <table class="table table-hover align-middle datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Birth Date</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Username</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($patients)): ?>
                                <?php foreach ($patients as $pat): ?>
                                    <tr>
                                        <td class="fw-bold text-muted">#<?php echo $pat['id_patient']; ?></td>
                                        <td class="fw-semibold"><?php echo html_escape($pat['full_name']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($pat['birth_date'])); ?></td>
                                        <td><?php echo html_escape($pat['address']); ?></td>
                                        <td><?php echo html_escape($pat['phone_number']); ?></td>
                                        <td><span class="badge bg-light text-dark">@<?php echo html_escape($pat['username']); ?></span></td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-2">
                                                <a href="<?php echo base_url('admin/patients_edit/' . $pat['id_patient']); ?>" class="btn btn-outline-secondary btn-sm" title="Edit Patient">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="<?php echo base_url('admin/patients_delete/' . $pat['id_patient']); ?>" method="POST" class="d-inline">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-delete" data-name="<?php echo html_escape($pat['full_name']); ?>" title="Delete Patient">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
