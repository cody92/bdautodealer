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
                    <th>Total modele</th>
                    <th>Total motorizari</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $id => $auto) : ?>
                    <tr>
                        <td class="center"><?php echo $auto['name']; ?></td>
                        <td class="center"><?php echo $auto['description']; ?></td>
                        <td class="center"></td>
                        <td class="center"><?php echo $auto['totalModels']; ?></td>
                        <td class="center"><?php echo $auto['totalEngines']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-success" href="/model/add/<?php echo $auto['id']; ?>" >

                                Adauga model
                            </a>
                            <br />
                            <a class="btn-mini btn-warning" href="/model/listModels/<?php echo $auto['id']; ?>">

                                Vezi modele
                            </a>
                            <br />
                            <a class="btn-mini btn-success" href="/engine/add/<?php echo $auto['id']; ?>">

                                Adauga motorizare
                            </a>
                            <br />
                            <a class="btn-mini btn-info" href="/car/edit/<?php echo $auto['id']; ?>">

                                Editeaza marca
                            </a>
                            <br />
                            <a class="btn-mini btn-warning" href="/engine/listEngine/<?php echo $auto['id']; ?>">

                                Vezi motorizari
                            </a>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>


            </tbody>
        </table>
    </div>
</div>