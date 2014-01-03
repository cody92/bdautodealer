<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista echipamente <?php echo $modelName; ?></h2>
    </div>
    <div class="box-content">

        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Pret</th>
                    <th>Echipament</th>
                    <th>Descriere</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $equipment) : ?>
                    <tr>
                        <td class="center"><?php echo $equipment['price']; ?></td>
                        <td class="center"><?php echo $equipment['name']; ?></td>
                        <td class="center"><?php echo $equipment['description']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/auto/deleteEquipment/<?php echo $equipment['id']; ?>">
                                <i class="icon-remove icon-white"></i>
                                Sterge echipament
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>