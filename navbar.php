
<nav class="navbar navbar-expand-lg bg-dark text-white" >
  <a class="navbar-brand text-white" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a>
  <a class="navbar-brand text-white" href="categories.php"><?php echo lang('CATEGORIES') ?></a>
  <a class="navbar-brand text-white" href="items.php"><?php echo lang('ITEMS') ?></a>
  <a class="navbar-brand text-white" href="members.php?do=Manage"> <?php echo lang('MEMBERS') ?></a>
  <a class="navbar-brand text-white" href="#"><?php echo lang('STATISICE') ?></a>
  <a class="navbar-brand text-white" href="#"><?php echo lang('LOGS') ?></a>
  <a class="navbar-brand text-white" href="contactus.php">Contact Us</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  
    <ul class="navbar-nav mr-auto">
      
      <div class="items_left">
      <li class="nav-item dropdown  ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo lang('ITEMS') ?>
        </a>
        <div class="collapse navbar-collapse" id="app-nav">
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>"><?php echo lang('EDITE') ?></a>
          <a class="dropdown-item " href="#"><?php echo lang('SETTING') ?></a>
          <a class="dropdown-item " href="logout.php"><?php echo lang('LOGOUT_USER') ?></a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>