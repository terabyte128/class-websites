<!--
The header that appears under the "transfusion" when a teacher is logged in,
allows for easy navigation to home page or to log out
-->

<div class="header">
    <div style='margin-bottom: -30px;'>
        <a href="/"><img src="/image/title.png" style="height: 120px;"></a>
    </div>
</div>
<?php if (isset($_SESSION['username'])) { ?>
    <div class="subheader">
        <p style="color: rgb(247, 247, 257); font-weight: bold;">
            You are logged in as <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?>
            &mdash; 
            <a style='color: #C4C4C4;' href='/teacher/<?php echo $_SESSION["username"]; ?>'>Go to your home page</a>
            &mdash; 
            <a href="/logout.php" style="color: #C4C4C4;">Log Out</a></p>
    </div>
<?php } ?>