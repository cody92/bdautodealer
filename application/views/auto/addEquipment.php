
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
                            <select id="equipments" name="equipments" multiple data-rel="chosen">
                                <option>Option 1</option>
                                <option selected>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
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
