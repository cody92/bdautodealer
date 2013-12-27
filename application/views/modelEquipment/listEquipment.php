<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista echipamente auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Pret</th>
                    <th>Model</th>
                    <th>Optiune</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $equipment) : ?>
                    <tr>
                        <td class="center"><?php echo $equipment['price']; ?></td>
                        <td class="center"><?php echo $equipment['aName'] . ' ' . $equipment['mName']; ?></td>
                        <td class="center"><?php echo $equipment['eqName'] . '<br />' . $equipment['value']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/modelEquipment/edit/<?php echo $equipment['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Editeaza echipament
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>