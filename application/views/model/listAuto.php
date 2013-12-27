<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista modele auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Nume Masina</th>
                    <th>Descriere Masina</th>
                    <th>Nume Marca</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $auto) : ?>
                    <tr>
                        <td><?php echo $auto['name']; ?></td>
                        <td class="center"><?php echo $auto['weight']; ?></td>
                        <td class="center"><?php echo $auto['doorsNumber']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/auto/edit/<?php echo $auto['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Editeaza masina
                            </a>
                            <a class="btn-mini btn-success" href="/auto/addEquipment/<?php echo $auto['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Adauga echipament
                            </a>
                            <a class="btn-mini btn-success" href="/auto/listEquipment/<?php echo $auto['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Lista echipament
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>