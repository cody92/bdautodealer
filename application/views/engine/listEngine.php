<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista modele auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Nume Motor</th>
                    <th>Tip Motor</th>
                    <th>Capacitate</th>
                    <th>Putere</th>
                    <th>Consum</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $engine) : ?>
                    <tr>
                        <td><?php echo $engine['name']; ?></td>
                        <td class="center"><?php echo $type[$engine['type']]; ?></td>
                        <td class="center"><?php echo $engine['capacity']; ?></td>
                        <td class="center"><?php echo $engine['horsePower']; ?></td>
                        <td class="center">
                            Extra: <?php echo $engine['fuelExtra']; ?> <br />
                            Urban: <?php echo $engine['fuelUrban']; ?> <br />
                            Mediu: <?php echo $engine['fuelAverage']; ?> <br />
                        </td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/engine/edit/engineId/<?php echo $engine['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Editeaza motorizare
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>