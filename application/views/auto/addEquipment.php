
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('auto/addEquipment/' . $id); ?>">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="equipments">Adauga echipamente</label>
                        <div class="controls">
                            <select id="equipments" name="equipments[]" multiple data-rel="chosen">
                                <option></option>
                                <?php
                                foreach ($equipments as $equip) :
                                    ?>
                                    <option value="<?php echo $equip['id']; ?>"><?php echo $equip['value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="add" class="btn btn-primary">Salveaza</button>

                    </div>
                </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
