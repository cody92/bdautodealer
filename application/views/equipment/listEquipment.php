<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2>Lista modele auto</h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>Nume Echipament</th>
                    <th>Descriere Echipament</th>
                    <th>Pret Echipament</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $equipment) : ?>
                    <tr>
                        <td><?php echo $equipment['name']; ?></td>
                        <td class="center"><?php echo $equipment['description']; ?></td>
                        <td class="center"><?php echo $equipment['price']; ?></td>
                        <td class="center">
                            <a class="btn-mini btn-danger" href="/equipment/edit/<?php echo $equipment['id']; ?>">
                                <i class="icon-edit icon-white"></i>
                                Editeaza equipment
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>