
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('model/add' . ($carId ? ('/carId/' . $carId) : '')); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['name'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Nume model*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="name" name="name" type="text"
                                   value="<?php
                                   if (isset($data['name']) && !empty($data['name'])) {
                                       echo $data['name'];
                                   }
                                   ?>">
                                   <?php if (isset($errors['name'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['name']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['releaseYear'])) : ?>error<?php endif; ?>">
                        <label class="control-label " for="releaseYear">An*:</label>
                        <div class="controls">

                            <select id="releaseYear" name="releaseYear" data-rel="chosen">
                                <option ></option>
                                <?php
                                for ($year = 1950; $year < 2030; $year++) :
                                    ?>
                                    <option
                                    <?php
                                    if (
                                        isset($data['releaseYear']) && !empty($data['releaseYear']) && $data['releaseYear'] == $year
                                    ) {
                                        echo "selected";
                                    }
                                    ?>

                                        value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php endfor; ?>

                            </select>
                            <?php if (isset($errors['releaseYear'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['releaseYear']); ?>
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
                    <div class="control-group <?php if (isset($errors['description'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="textarea2">Descriere model*:</label>
                        <div class="controls">
                            <textarea class="cleditor" id="description" name="description" rows="3">
                                <?php
                                if (isset($data['description']) && !empty($data['description'])) {
                                    echo $data['description'];
                                }
                                ?>
                            </textarea>
                            <?php if (isset($errors['description'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['description']); ?>
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
