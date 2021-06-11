<?php
include 'functions_custom.php';
$pdo= pdo_connect_mysql();



if ($pdo) {
$query = $pdo->prepare('SELECT * FROM `students`');

$query->execute();

$students = $query->fetchAll(PDO::FETCH_ASSOC);

}
else {
 print " Connexion refusé !"; 
}
?>
<?php echo template_header('Read'); ?>

<div class="content read">
	<h2>Voir les STUDENTS</h2>
	<a href="create.php" class="create-contact">Créer un étudiant</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Email</td>
                <td>Age</td>
                <td>Phone</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student):?>
     
            <tr>
                <td><?=$student['ID']?></td>
                <td><?=$student['last_name']?></td>
                <td><?=$student['first_name']?></td>
                <td><?=$student['email']?></td>
                <td><?=$student['age']?></td>
                <td><?=$student['phone']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$student['ID']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$student['ID']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php echo template_footer(); ?>