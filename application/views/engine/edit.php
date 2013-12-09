
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('engine/edit/' . $id); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['type'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="type">Tip motor*:</label>
                        <div class="controls">
                            <select id="carId" name="type" data-rel="chosen" required="">
                                <?php foreach ($types as $key => $type) : ?>
                                    <option value="<?php echo $key; ?>"
                                    <?php if ($data['type'] == $key) : ?>
                                                selected
                                            <?php endif; ?>
                                            ><?php echo $type; ?></option>
                                        <?php endforeach; ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group <?php if (isset($errors['name'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Nume motorizare*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="name" name="name" type="text"
                                   value="<?php
                                   if (isset($data['name']) && !empty($data['name'])) {
                                       echo $data['name'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['name'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['name']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['capacity'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Capacitate(pentru GPL,DIESEL si Benzina):</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="capacity" name="capacity" type="number"
                                   value="<?php
                                   if (isset($data['capacity']) && !empty($data['capacity'])) {
                                       echo $data['capacity'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['capacity'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['capacity']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['horsePower'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Putere motor:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="horsePower" name="horsePower" type="number"
                                   value="<?php
                                   if (isset($data['horsePower']) && !empty($data['horsePower'])) {
                                       echo $data['horsePower'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['horsePower'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['horsePower']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['fuelUrban'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Consum urban*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="fuelUrban" name="fuelUrban" type="number"
                                    step="any" value="<?php
                                    if (isset($data['fuelUrban']) && !empty($data['fuelUrban'])) {
                                        echo $data['fuelUrban'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['fuelUrban'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['fuelUrban']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['fuelExtra'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Consum extra-urban*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="fuelExtra" name="fuelExtra" type="number"
                                    step="any" value="<?php
                                    if (isset($data['fuelExtra']) && !empty($data['fuelExtra'])) {
                                        echo $data['fuelExtra'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['fuelExtra'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['fuelExtra']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['fuelAverage'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Consum mediu*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="fuelAverage" name="fuelAverage" type="number"
                                    step="any" value="<?php
                                    if (isset($data['fuelAverage']) && !empty($data['fuelAverage'])) {
                                        echo $data['fuelAverage'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['fuelAverage'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['fuelAverage']); ?>
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
