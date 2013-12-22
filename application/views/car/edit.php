
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('car/edit/' . $id); ?>">
                <fieldset>
                    <div class="control-group <?php if (isset($errors['name'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="focusedInput">Nume marca*:</label>
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
                    <div class="control-group">
                        <label class="control-label" for="fileInput">Incarca logo:</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="logo" name="logo" type="file">

                        </div>
                    </div>
                    <div class="control-group <?php if (isset($errors['description'])) : ?>error <?php endif; ?>">
                        <label class="control-label" for="textarea2">Descriere marca*:</label>
                        <div class="controls">
                            <textarea class="cleditor" id="description" name="description" rows="3">
                                <?php
                                if (isset($data['description']) && !empty($data['description'])) {
                                    echo $data['description'];
                                }
                                ?>
                            </textarea>
                            <?php if (isset($errors['description'])) : ?>
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
