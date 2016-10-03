<section class="content ">
    <div class="row box" >
        <!-- left column -->
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $this->lang->line('patients', FALSE) ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="frmPatient" name="frmPatient">
                    <input type="hidden" id="patients_id" name="patients_id"  value=""/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('patientname', FALSE) ?></label>
                            <input type="user" class="form-control" name="fullname" id="fullname" placeholder="<?= $this->lang->line('patientname_ph', FALSE) ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('email', FALSE) ?></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="<?= $this->lang->line('email_ph', FALSE) ?>">
                        </div>                                                                
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('phone', FALSE) ?></label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="<?= $this->lang->line('phone_ph', FALSE) ?>">
                        </div>                                                                
                        <div class="form-group">
                            <label><?= $this->lang->line('sex', FALSE) ?></label>
                            <select class="form-control select2" name="sex" id="sex" style="width: 45%;">
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('age', FALSE) ?></label>
                            <input type="text" class="form-control" name="age" id="age" placeholder="<?= $this->lang->line('age_ph', FALSE) ?>">
                        </div>    
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('patientcode', FALSE) ?></label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="<?= $this->lang->line('patientcode_ph', FALSE) ?>">
                        </div>                         
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="button" class="btn btn-primary" id="btnPatientSave"><?= $this->lang->line('add', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" id="btnPatientUpdate"><?= $this->lang->line('update', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" id="btnPatientDel" ><?= $this->lang->line('delete', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </form>
                <div id="divErrors" name="divErrors"></div>
            </div>
            <!-- /.box -->

        </div>

        <!-- right column -->
        <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= $this->lang->line('patientlist', FALSE) ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="PatientTable"  name="PatientTable" class="table table-bordered table-hover">
                            <thead>
                            <th><?= $this->lang->line('patientid', FALSE) ?></th>
                            <th><?= $this->lang->line('fullname', FALSE) ?></th>
                            <th><?= $this->lang->line('sex', FALSE) ?></th>
                            <th><?= $this->lang->line('age', FALSE) ?></th>
                            <th><?= $this->lang->line('email', FALSE) ?></th>
                            <th><?= $this->lang->line('phone', FALSE) ?></th>
                            <th><?= $this->lang->line('patientcode', FALSE) ?></th>
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
</section>

