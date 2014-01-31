<?php
$query = $_GET['query'];

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db-connect.php";

# set up a db query for the user's query
$dbQuery = $db->prepare("SELECT first_name, last_name, username FROM " . TEACHER_LOGIN_TABLE . " WHERE first_name LIKE ? OR last_name LIKE ? OR username LIKE ?");

$encapsulatedQuery = '%' . $query . '%';

try {
    $dbQuery->execute(array($encapsulatedQuery, $encapsulatedQuery, $encapsulatedQuery));
} catch (PDOException $e) {
    die("Unable to query database: " . $e->getMessage());
}
?>
<?php
if (isset($_SESSION['username'])) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
        <title>Transfusion - Home</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
                <div class="page-content">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/messages.php'; ?>
                    <div class="card">
                        <p class="title">Search Results: <?php echo $query; ?></p>
                        <form role="form" class='form-inline' onsubmit="search($('#teacherSearch').val());
                                return false;">
                            <p>Refine your search:</p>
                            <div class="form-group">
                                <label for="teacherSearch" class='sr-only'>Refine your search:</label>
                                <input id="teacherSearch" class="form-control" placeholder="" value="<?php echo $query; ?>">
                            </div>
                            <div class='form-group'>
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                        </form>
                        <br />
                        <ul>
                            <?php
                            if ($dbQuery->rowCount() !== 0) {
                                while ($row = $dbQuery->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<li>';
                                    echo '<a href="/teacher/' . $row['username'] . '">';
                                    echo $row['first_name'] . " " . $row['last_name'];
                                    echo '<a>';
                                    echo '</li>';
                                }
                            } else {
                                echo '<li>No results found.</li>';
                            }
                            ?>
                        </ul>
                    </div>

                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
                </div>
            </div>
        </div>
        <script type='text/javascript'>
                            function search(query) {
                                if(query !== "") {
                                    hideMessage();
                                    window.location = "/search/" + query;
                                } else {
                                    showMessage("Please enter a query.", "warning");
                                }
                            }
        </script>
    </body>
</html>
