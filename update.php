<?php 
include 'functions_custom.php';
$pdo = pdo_connect_mysql();
$msg='';
if (isset($_GET['id'])) {
	if (!empty($_POST)) {
		$id = isset($_POST['id']) ? $_POST['ID'] : NULL;
		$firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
		$lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
		$age = isset($_POST['age']) ? $_POST['age'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
		//Update the record
		$query = $pdo->prepare('UPDATE students SET  first_name = ?, last_name= ?, age= ?, email= ?, phone= ? WHERE id= ?');
		$query->execute([$firstName, $lastName, $age, $email, $phone, $_GET['id']]);
		$msg ='Update Successfully';
	}
	$query = $pdo->prepare("SELECT * FROM students WHERE id= ?");
	$query->execute([$_GET['id']]);
	$student = $query->fetch(PDO::FETCH_ASSOC);
	if(!$student){
		exit("Contact doesn't exist with that ID!");
	}
}else {
	exit("No ID specified !");
}
?>

<?php echo template_header('Read'); ?>
<div class="content update">
	<h2>Update Student #<?=$student['ID']?></h2>
	<form action="update.php?id=<?=$student['ID']?>" method="post">
		<label for='id'> ID </label>
		<label for="first_name"> First Name </label>
		<input type="text" name="ID" placeholder="1" readonly value="<?=$student['ID']?>" id="id">
		<input type="text" name="first_name" placeholder="John" value="<?=$student['first_name']?>" id="firstName">
		<label for="age">Age</label>
		<label for="last_name">Last Name</label>
		<input type="text" name="age" placeholder="32" value="<?=$student['age']?>" id="age">
		<input type="text" name="last_name" placeholder="Doe" value="<?=$student['last_name']?>" id="lastName">
        <label for="email">E-Mail</label>
		<label for="phone"> Phone </label>
		<input type="text" name="email" placerholder="johndoe@example.com" value="<?=$student['email']?>" id="email">
		<input type="text" name="phone" placeholder="568578" value="<?=$student['phone']?>" id="phone">
		
		<input type="submit" value="Update">
	</form>
<?php if ($msg):?>
	<p><?= $msg?></p>
	<?php endif;?>
</div>
<?php echo template_footer(); ?>