<section class="content ">
    <div class="row box"  style="margin: auto;width: auto;">
        <!-- left column -->
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $this->lang->line('users', FALSE) ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="frmUser" name="frmUser">
                    <input type="hidden" id="user_id" name="user_id"  value=""/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('user_name', FALSE) ?></label>
                            <input type="user" class="form-control" name="username" id="username" placeholder="<?= $this->lang->line('user_name_ph', FALSE) ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('fullname', FALSE) ?></label>
                            <input type="fullname" class="form-control" name="fullname" id="fullname" placeholder="<?= $this->lang->line('fullname_ph', FALSE) ?>">
                        </div>
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('password', FALSE) ?></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="<?= $this->lang->line('password_ph', FALSE) ?>">
                        </div>                                                                
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('email', FALSE) ?></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="<?= $this->lang->line('email_ph', FALSE) ?>">
                        </div>                                                                
                        <div class="form-group">
                            <label for="text"><?= $this->lang->line('phone', FALSE) ?></label>
                            <input type="email" class="form-control" name="phone" id="phone" placeholder="<?= $this->lang->line('phone_ph', FALSE) ?>">
                        </div>                                                                
                        <div class="form-group">
                            <label><?= $this->lang->line('userrole', FALSE) ?></label>
                            <select class="form-control select2" name="role_id" id="role_id" style="width: 45%;">
                                <?php
                                $result = $this->db->get("roles");
                                $rows = $result->result_array();
                                foreach ($rows as $row) {
                                    print "<option value=\"{$row['role_id']}\">{$row['role_name']}</option>";
                                }
                                ?>    
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="button" class="btn btn-primary" id="BtnUserSave"><?= $this->lang->line('add', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" id="BtnUserUpdate"><?= $this->lang->line('update', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" id="BtnUserDel" ><?= $this->lang->line('delete', FALSE) ?></button><label for="text">&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
                        <h3 class="box-title"><?= $this->lang->line('userlist', FALSE) ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="UserTable"  name="UserTable" class="table table-bordered table-hover">
                            <thead>
                            <th><?= $this->lang->line('userid', FALSE) ?></th>
                            <th><?= $this->lang->line('user_name', FALSE) ?></th>
                            <th><?= $this->lang->line('fullname', FALSE) ?></th>
                            <th><?= $this->lang->line('rolename', FALSE) ?></th>
                            <th><?= $this->lang->line('email', FALSE) ?></th>
                            <th><?= $this->lang->line('phone', FALSE) ?></th>
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

