
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('engine/add'); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['engine_type'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="engine_type">Tip motor*:</label>
                        <div class="controls">
                            <select id="carId" name="engine_type" data-rel="chosen" required="">
                                <?php foreach ($types as $key => $type) : ?>
                                    <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group <?php if (isset($errors['engine_name'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Nume motorizare*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="engine_name" name="engine_name" type="text"
                                   value="<?php
                                   if (isset($data['engine_name']) && !empty($data['engine_name'])) {
                                       echo $data['engine_name'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['engine_name'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engine_name']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['engine_capacity'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Capacitate(pentru GPL,DIESEL si Benzina):</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="engine_capacity" name="engine_capacity" type="number"
                                   value="<?php
                                   if (isset($data['engine_capacity']) && !empty($data['engine_capacity'])) {
                                       echo $data['engine_capacity'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['engine_capacity'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engine_capacity']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['engine_power'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Putere motor:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="engine_power" name="engine_power" type="number"
                                   value="<?php
                                   if (isset($data['engine_power']) && !empty($data['engine_power'])) {
                                       echo $data['engine_power'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['engine_power'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engine_power']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['engine_urban'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Consum urban*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="engine_urban" name="engine_urban" type="number"
                                    step="any" value="<?php
                                    if (isset($data['engine_urban']) && !empty($data['engine_urban'])) {
                                        echo $data['engine_urban'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['engine_urban'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engine_urban']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['engine_extra'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Consum extra-urban*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="engine_extra" name="engine_extra" type="number"
                                    step="any" value="<?php
                                    if (isset($data['engine_extra']) && !empty($data['engine_extra'])) {
                                        echo $data['engine_extra'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['engine_extra'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engine_extra']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['engine_average'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Consum mediu*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="engine_average" name="engine_average" type="number"
                                    step="any" value="<?php
                                    if (isset($data['engine_average']) && !empty($data['engine_average'])) {
                                        echo $data['engine_average'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['engine_average'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engine_average']); ?>
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
