<?php 

    $request = \Config\Services::request();
    $uri = $request->uri->getSegment(1);

    $active_1 = '';
    $active_2 = '';
    $active_3 = '';
    $active_4 = '';
    $active_5 = '';

    $active_sub_1 = '';
    $active_sub_2 = '';
    $active_sub_3 = '';
    $active_sub_4 = '';

    if ($uri == 'words') {
        $active_1 = 'active';
    } else if ($uri == 'sentences') {
        $active_2 = 'active';
    } else if ($uri == 'irregular') {
        $active_3 = 'active';
    } else if ($uri == 'game') {
        $active_4 = 'active';
    } else if ($uri == 'profile' || $uri == 'history' || $uri == 'mistakes' || $uri == 'export') {
        $active_5 = 'active';
    } 

    if ($uri == 'mistakes') {
        $active_sub_1 = 'active_sub';
    } else if ($uri == 'history') {
        $active_sub_2 = 'active_sub';
    } else if ($uri == 'profile') {
        $active_sub_3 = 'active_sub';
    } else if ($uri == 'export') {
        $active_sub_4 = 'active_sub';
    } 


?>

<header>
<nav class="navbar navbar-expand-md navbar-light fixed-top" id="neubar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" height="60" alt="logo-navbar"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">


                <!--No Logged Navbar-->
                <?php 
                    if(!isLoggedBool()) 
                    {
                ?>
                <li class="nav-item">
                    <a class="nav-link mx-2 nav-no-register" href="#">Words</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 nav-no-register" href="#">Sentences</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 nav-no-register" href="#">Game</a>
                </li>


                <?php 
                    }
                ?>

                <!--Logged Navbar-->
                <?php 
                    if(isLoggedBool()) 
                    {
                ?>
                <li class="nav-item">
                    <a id="nav-word-href" class="nav-link mx-2 <?php echo $active_1; ?>" href="<?php echo base_url(); ?>words">Words</a>
                </li>

                <li class="nav-item">
                    <a id="nav-sentence-href" class="nav-link mx-2 <?php echo $active_2; ?>" href="<?php echo base_url(); ?>sentences">Sentences</a>
                </li>

                <?php if(session()->get('id_native_language') == '1') { ?>

                    <li class="nav-item">
                        <a class="nav-link mx-2 <?php echo $active_3; ?>" href="<?php echo base_url(); ?>irregular">Irregular</a>
                    </li>
                
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link mx-2 <?php echo $active_4; ?>" href="<?php echo base_url(); ?>game">Game</a>
                </li>


                <?php 
                    }
                ?>


                <!--Login/Register-->
                <?php 
                    if(!isLoggedBool()) 
                    {
                ?>
                
                <li class="nav-item" id="register-nav">
                    <a class="nav-link mx-2" href="#">Register</a>
                </li>
                <li class="nav-item" id="login-nav">
                    <a class="nav-link mx-2" href="#">Login</a>     
                </li>

                <?php 
                    }
                ?>


                <!--Profile-->
                <?php 
                    if(isLoggedBool()) 
                    {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link mx-2 dropdown-toggle <?php echo $active_5; ?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, <?php echo session()->get('user_nickname'); ?>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li class="nav-item">
                            <a class="dropdown-item <?php echo $active_sub_1; ?>" href="<?php echo base_url(); ?>mistakes">Mistakes</a>
                        </li>
                        <li>
                            <a class="dropdown-item <?php echo $active_sub_2; ?>" href="<?php echo base_url(); ?>history">History</a>
                        </li>
                        <li>
                            <a class="dropdown-item <?php echo $active_sub_3; ?>" href="<?php echo base_url(); ?>profile">Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item <?php echo $active_sub_4; ?>" href="<?php echo base_url(); ?>export">Export</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">Logout</a>
                        </li>
                    </ul>
                </li>
                <?php 
                    }
                ?>

            </ul>
        </div>
    </div>
</nav>






</header>