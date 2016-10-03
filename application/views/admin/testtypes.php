    <div class="row box"  style="margin: auto;width: auto;">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $this->lang->line('test_types', FALSE) ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="frmTestTypes" name="frmTestTypes">
                    <input type="hidden" id="test_types_id" name="test_types_id"  value=""/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('test_name', FALSE) ?></label>
                            <input type="text" class="form-control" name="test_name" id="test_name" placeholder="<?= $this->lang->line('test_name_ph', FALSE) ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('test_explain', FALSE) ?></label>
                            <textarea id="explain" name="explain" rows="10" cols="40">
                                            Explain of Test Method
                            </textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="button" class="btn btn-primary" id="BtnTestTSave"><?= $this->lang->line('add', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" id="BtnTestTUpdate"><?= $this->lang->line('update', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" id="BtnTestTDel" ><?= $this->lang->line('delete', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </form>
                <div id="divErrors" name="divErrors"></div>
            </div>
            <!-- /.box -->

        </div>

        <!-- right column -->
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= $this->lang->line('testlist', FALSE) ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="TestTable"  name="TestTable" class="table table-bordered table-hover">
                            <thead>
                            <th><?= $this->lang->line('test_types_id', FALSE) ?></th>
                            <th><?= $this->lang->line('test_name', FALSE) ?></th>
                            <th><?= $this->lang->line('test_explain', FALSE) ?></th>
                            <th><?= $this->lang->line('user_name', FALSE) ?></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->

