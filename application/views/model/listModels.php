<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista modele auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Nume Model</th>
                    <th>Descriere Model</th>
                    <th>Nume Marca</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $auto) : ?>
                    <tr>
                        <td><?php echo $auto['name']; ?></td>
                        <td class="center"><?php echo $auto['description']; ?></td>
                        <td class="center"><?php echo $auto['numeMarca']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/model/edit/modelId/<?php echo $auto['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Editeaza model
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>