<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vlasnici_automobila";
$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error) {
    echo $conn->connect_error;
    die();
  }
if (isset($_POST["autounesi"])){
    $reg = $_POST['reg'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $datum = $_POST['datum'];
    $stmt = $conn->prepare("INSERT INTO vlasnici_automobila.automobil(Registracija,Marka,Model,DatumProizvodnje)
        VALUES('$reg','$marka','$model','$datum');
    ");
    $stmt->execute(); 

}
if (isset($_POST["vlasnikaunesi"])){
    $jmbg = $_POST['jmbg'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $datum = $_POST['datum'];
    $adresa = $_POST['adresa'];
    $stmt = $conn->prepare("INSERT INTO vlasnici_automobila.vlasnik(jmbg,Ime,Prezime,DatumRodjenja,Adresa)
        VALUES('$jmbg','$ime','$prezime','$datum','$adresa');
    ");
    $stmt->execute(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        Registracija:
        <input type="text" name="reg"><br>
        Marka:
        <input type="text" name="marka"><br>
        Model:
        <input type="text" name="model"><br>
        Datum proizvodnje:
        <input type="date" name="datum"><br>
        <input type="submit" name="autounesi" value="Unesi auto"><br>
    </form>
    <form method="post">
        JMBG:
        <input type="text" name="jmbg"><br>
        Ime:
        <input type="text" name="ime"><br>
        Prezime:
        <input type="text" name="prezime"><br>
        Datum rodjenja:
        <input type="date" name="datum"><br>
        Adresa:
        <input type="text" name="adresa"><br>
        <input type="submit" name="vlasnikaunesi" value="Unesi vlasnika"><br>
        <input type="submit" name="ivlasnik" value="Ispisi vlasnika"><br>
        <input type="submit" name="iauto" value="Ispisi auto"><br>
    </form>
</body>
</html>

<?php
if(isset($_POST['ivlasnik'])){
    $stmt=$conn->prepare("SELECT * FROM vlasnik");
    $stmt->execute();
    $res= $stmt->get_result();
    while($row=$res->fetch_assoc()){
        echo $row['Ime']." ".$row['Prezime'];
    }
}

?>