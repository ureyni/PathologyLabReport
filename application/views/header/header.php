<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$this->config->item('WEB_PAGE_HEADER'); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="/assets/plugins/datatables/jquery.dataTables.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="/assets/plugins/datepicker/datepicker3.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand"><b> <?= $this->config->item('LAB_NAME'); ?></b></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <?php if ($this->session->userdata('logged') == true) { ?>
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="/reports/main"><?= $this->lang->line('reports', FALSE) ?></a>
                                </li>
                                <li>
                                    <a href="/patient/proc" ><?= $this->lang->line('patients', FALSE) ?></a>
                                </li>                                
                                    <?php if ($this->session->userdata('type') == 1) { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $this->lang->line('settings', FALSE) ?><span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#"><?= $this->lang->line('labinfo', FALSE) ?></a></li>
                                            <li><a href="/testtypes/list"><?= $this->lang->line('testtypes', FALSE) ?></a></li>
                                            <li><a href="#"><?= $this->lang->line('mailsettings', FALSE) ?></a></li>
                                            <li class="divider"></li>
                                            <li><a href="/users/list"><?= $this->lang->line('usersmenu', FALSE) ?></a></li>
                                            <li class="divider"></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                        <!-- /.navbar-collapse -->
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- /.messages-menu -->

                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="/assets/dist/img/human-icon-png-1904.png" class="user-image" alt="User Image">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs"><?=$this->session->userdata('fullname');?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <img src="/assets/dist/img/human-icon-png-1904.png" class="img-circle" alt="User Image">

                                            <p>
                                                <?=$this->session->userdata('fullname').' '.
                                                ($this->session->userdata('logged_patient')?$this->lang->line('userpatient', FALSE):
                                                    $this->lang->line('useroperator', FALSE))?>
                                            </p>
                                        </li>
                                        <!-- Menu Body -->
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-right">
                                                <a href="/userlogin/signout" class="btn btn-default btn-flat"><?=$this->lang->line('signout', FALSE) ?></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-custom-menu -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <div class="content-wrapper">
                <section class="content" style="margin: auto;width: 85%;">
