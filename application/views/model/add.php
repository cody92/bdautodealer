
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('model/add' . ($carId ? ('/carId/' . $carId) : '')); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['nume_model'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Nume model*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="nume_model" name="nume_model" type="text"
                                   value="<?php
                                   if (isset($data['nume_model']) && !empty($data['nume_model'])) {
                                       echo $data['nume_model'];
                                   }
                                   ?>">
                                   <?php if (isset($errors['nume_model'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['nume_model']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['year'])) : ?>error<?php endif; ?>">
                        <label class="control-label " for="year">An*:</label>
                        <div class="controls">
                            <input type="text" name="year" class="input-xlarge datepicker" id="year" value="<?php
                            if (isset($data['year']) && !empty($data['year'])) {
                                echo $data['year'];
                            }
                            ?>">
                                   <?php if (isset($errors['year'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['year']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (!$carId) : ?>
                        <div class="control-group <?php if (isset($errors['carId'])) : ?>error <?php endif; ?>">
                            <label class="control-label" for="carId">Marca*:</label>
                            <div class="controls">
                                <select id="carId" name="carId" data-rel="chosen">
                                    <?php foreach ($cars as $car) : ?>
                                        <option value="<?php echo $car['id']; ?>"><?php echo $car['name']; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                    <?php else : ?>
                        <input type="hidden" value="<?php echo $carId; ?>" name="carId" />
                    <?php endif; ?>
                    <div class="control-group <?php if (isset($errors['descriere_model'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="textarea2">Descriere model*:</label>
                        <div class="controls">
                            <textarea class="cleditor" id="descriere_model" name="descriere_model" rows="3">
                                <?php
                                if (isset($data['descriere_model']) && !empty($data['descriere_model'])) {
                                    echo $data['descriere_model'];
                                }
                                ?>
                            </textarea>
                            <?php if (isset($errors['descriere_model'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['descriere_model']); ?>
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
