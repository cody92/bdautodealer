
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('auto/edit/' . $id); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['engineId'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="engineId">Motorizare*:</label>
                        <div class="controls">
                            <select id="carId" name="engineId" data-rel="chosen">
                                <option></option>
                                <?php foreach ($engines as $key => $engine) : ?>
                                    <option value="<?php echo $engine['id']; ?>"><?php echo $engine['name']; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?php if (isset($errors['engineId'])) : ?>
                                <br />
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['engineId']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php if (isset($errors['name'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Nume masina*:</label>
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
                    <div class="control-group <?php if (isset($errors['price'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Pret*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="price" name="price" type="number"
                                    step="any" value="<?php
                                    if (isset($data['price']) && !empty($data['price'])) {
                                        echo $data['price'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['price'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['price']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['weight'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Greautate(kg)*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="weight" name="weight" type="number"
                                   value="<?php
                                   if (isset($data['weight']) && !empty($data['weight'])) {
                                       echo $data['weight'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['weight'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['weight']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['seatsNumber'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Numar locuri*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="seatsNumber" name="seatsNumber" type="number"
                                   value="<?php
                                   if (isset($data['seatsNumber']) && !empty($data['seatsNumber'])) {
                                       echo $data['seatsNumber'];
                                   }
                                   ?>" required />
                                   <?php if (isset($errors['seatsNumber'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['seatsNumber']); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['doorsNumber'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Numar usi*:</label>
                        <div class="controls">
                            <input  class="input-xlarge focused" id="doorsNumber" name="doorsNumber" type="number"
                                    step="any" value="<?php
                                    if (isset($data['doorsNumber']) && !empty($data['doorsNumber'])) {
                                        echo $data['doorsNumber'];
                                    }
                                    ?>" required />
                                    <?php if (isset($errors['doorsNumber'])) : ?>
                                <span class="help-inline">
                                    <?php echo implode(',', $errors['doorsNumber']); ?>
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
