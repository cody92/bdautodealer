
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $this->title; ?></h2>

        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php echo $this->url('car/adaugaMarca'); ?>">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Nume marca*:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="nume_marca" name="nume_marca" type="text" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fileInput">Incarca logo:</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="logo_file" name="logo_file" type="file">
                        </div>
                    </div> 
                    <div class="control-group">
                        <label class="control-label" for="textarea2">Descriere marca*:</label>
                        <div class="controls">
                            <textarea class="cleditor" id="descriere_marca" name="descriere_marca" rows="3"></textarea>
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
