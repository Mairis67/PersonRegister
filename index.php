<?php

require_once 'vendor/autoload.php';

$connectionParams = [
    'dbname' => 'registry',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Person Registration</title>
    </head>
    <body>

    <form action="" method="post" class="form">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Name" id="name" class="name">
        <br>
        <label for="surname">Surname:</label>
        <input type="text" name="surname" placeholder="Surname" class="surname" id="surname">
        <br>
        <label for="insurance-number">Insurance number</label>
        <input type="number" name="insurance_number" placeholder="Insurance Number" id="insurance-number" class="inum">
        <br>
        <button type="submit" name="submit" class="submit_button">Submit</button>
    </form>

    <form action="/" method="post" class="form">
        <button type="submit" name="search" class="search_button">Show</button>
    </form>

    </body>
    </html>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $insuranceNumber = $_POST['insurance_number'];

    $person = new \App\Person($name, $surname, $insuranceNumber);

    $registry = new \App\Registry();
    $registry->addToList($person);

    foreach ($registry->getPerson() as $p) {
        $conn->insert('users', ['name' => $p->getPersonName(), 'surname' => $p->getPersonSurname(),
            'insurance_number' => $p->getInsuranceNumber()]);
    }
}
?>

<div class="form">
<?php
if(isset($_POST['search'])) {
    $statement = $conn->prepare('SELECT * FROM users');
    $resultSet = $statement->executeQuery();
    $users = $resultSet->fetchAllAssociative();

    foreach ($users as $user) {
        echo $user['name'] . ' ' . $user['surname'] . ' ' . $user['insurance_number'];
        echo '<br>';
    }
}
?>
</div>








