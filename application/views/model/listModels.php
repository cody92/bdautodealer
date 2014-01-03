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
                    <th>Numar Masini</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $auto) : ?>
                    <tr>
                        <td class="center"><?php echo $auto['name']; ?></td>
                        <td class="center"><?php echo $auto['description']; ?></td>
                        <td class="center"><?php echo $auto['numeMarca']; ?></td>
                        <td class="center"><?php echo $auto['totalCars']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/model/edit/<?php echo $auto['id']; ?>">

                                Editeaza model
                            </a>

                            <a class="btn-mini btn-success" href="/auto/add/<?php echo $auto['id']; ?>">

                                Adauga masina
                            </a>
                            <br />
                            <a class="btn-mini btn-success" href="/model/listAuto/<?php echo $auto['id']; ?>">

                                Lista masini
                            </a>

                            <a class="btn-mini btn-danger" href="/modelEquipment/add/<?php echo $auto['id']; ?>">

                                Adauga optiune
                            </a>
                            <br />
                            <a class="btn-mini btn-danger" href="/modelEquipment/listEquipment/<?php echo $auto['id']; ?>">

                                Lista optiune
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>