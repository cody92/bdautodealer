
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('modelEquipment/add/' . $modelId); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['equipmentId'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="equipmentId">Optiune*:</label>
                        <div class="controls">
                            <select id="equipmentId" name="equipmentId" data-rel="chosen">
                                <option></option>
                                <?php foreach ($equipments as $option) : ?>
                                    <option
                                    <?php
                                    if (
                                        isset($data['equipmentId']) && !empty($data['equipmentId']) && $option['id'] == $data['equipmentId']) {
                                        echo 'selected';
                                    }
                                    ?>


                                        value="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></option>
                                    <?php endforeach; ?>

                            </select>
                            <?php if (isset($errors['equipmentId'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['equipmentId']); ?>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>
                    <input type="hidden" name="modelId" value="<?php echo $modelId; ?>" />
                    <div class="control-group <?php if (isset($errors['price'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Pret optiune*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="price" name="price" type="number"
                                   value="<?php
                                   if (isset($data['price']) && !empty($data['price'])) {
                                       echo $data['price'];
                                   }
                                   ?>">
                                   <?php if (isset($errors['price'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['price']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['value'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Valoare*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="value" name="value" type="text"
                                   value="<?php
                                   if (isset($data['value']) && !empty($data['value'])) {
                                       echo $data['value'];
                                   }
                                   ?>">
                                   <?php if (isset($errors['value'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['value']); ?>
                                </span>
                            <?php endif; ?>
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
