<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Marci Auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Nume Marca</th>
                    <th>Descriere Marca</th>
                    <th>Logo</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $auto) : ?>
                    <tr>
                        <td><?php echo $auto['name']; ?></td>
                        <td class="center"><?php echo $auto['description']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-success" href="/model/add/carId/<?php echo $auto['id']; ?>" >
                                <i class="icon-add icon-white"></i>
                                Adauga model
                            </a>
                            <a class="btn-mini btn-info" href="/model/list/carId/<?php echo $auto['id']; ?>">
                                <i class="icon-list icon-white"></i>
                                Vezi modele
                            </a>
                            <a class="btn-mini btn-danger" href="/car/edit/carId/<?php echo $auto['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Editeaza marca
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>