<div class="header">
    <h1 style="font-size: 48px;"><strong>transfusion</strong></h1>
</div>
<?php if(isset($_SESSION['username'])) { ?>
<div class="subheader">
    <p style="color: rgb(247, 247, 257); font-weight: bold;">You are logged in as <strong><?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></strong><a href="/logout.php" style="color: rgb(134, 0, 0); float: right;">Log Out</a></p>
</div>
<?php } ?>