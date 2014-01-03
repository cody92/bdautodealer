<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista modele auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Detalii Masina</th>
                    <th>Detalii Tehnice</th>
                    <th>Pret</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $auto) : ?>
                    <tr>
                        <td class="center">
                            <?php echo $auto['aName'] . " " . $auto['mName'] . " " . $auto['name']; ?>
                            <br />
                            <?php echo $auto['seatsNumber']; ?> locuri
                            <br />
                            <?php echo $auto['doorsNumber']; ?> usi


                        </td>
                        <td class="center">
                            <b>Motorizare:</b> <?php echo $auto['eName']; ?>
                            <br />
                            <b>Tip motorizare:</b> <?php echo EngineController::listEngineType()[$auto['eType']]; ?>
                            <br />
                            <b>Capacitate motor:</b> <?php echo $auto['eCapacity']; ?>
                            <br />
                            <b>Putere motor:</b> <?php echo $auto['eHorsePower']; ?> kW
                            <br />
                            <b>Consum:</b>
                            <br />
                            <?php echo $auto['eFuelUrban']; ?> urban
                            <br />
                            <?php echo $auto['eFuelExtra']; ?> extra-urban
                            <br />
                            <?php echo $auto['eFuelAverage']; ?> mediu
                            <br />
                            <b>Greutate: </b> <?php echo $auto['weight']; ?> kg


                        </td>
                        <td class="center">
                            Pret baza: <?php echo $auto['price']; ?>
                            <br />
                            Pret optiuni: <?php echo $auto['optionsPrice'] ? $auto['optionsPrice'] : 0; ?>
                        </td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/auto/edit/<?php echo $auto['id']; ?>">

                                Editeaza masina
                            </a>
                            <br />
                            <a class="btn-mini btn-success" href="/auto/addEquipment/<?php echo $auto['id']; ?>">

                                Adauga echipament
                            </a>
                            <br />
                            <a class="btn-mini btn-success" href="/auto/listEquipment/<?php echo $auto['id']; ?>">

                                Lista echipament
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>