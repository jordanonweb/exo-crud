<?php 
include 'functions_custom.php';
$pdo=pdo_connect_mysql();

$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
	$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO students VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $lastName, $firstName,$email, $age, $phone]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>
<div class="content update">
	<h2>Create Student</h2>
	<form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="last_name">Last Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="last_name" placeholder="John Doe" id="last_name">
        <label for="first_name">First Name</label>
        <label for="email">E-mail</label>
        <input type="text" name="first_name" placeholder="John" id="first_name">
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <label for="age">Age</label>
        <label for="phone">phone</label>
        <input type="text" name="age" placeholder="25" id="age">
        <input type="text" name="phone" placeholder="252525"  id="phone">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>