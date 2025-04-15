<?php
include('header.php');
?>

<style>

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    width: 50%;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

a {
    display: flex;
    justify-content: center;
    text-align: center;
}

table {
    width: 100%;
}

table td {
    display: block;
    text-align: left;
    margin-bottom: 10px;
}

table td.label {
    margin-bottom: 5px;
}

</style>

<h1>Inscription</h1>

<form action="userRegistrationForm-validation.php" method="post">
    <table id="baseline">
        <tr>
            <td class="label">Mail</td>
            <td><input type="email" name="bca-mail" id="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br></td>
        </tr>
        <tr>
            <td class="label">Mot de passe</td>
            <td><input type="password" name="bca-pwd" id="" pattern=".{8,}"></td>
        </tr>
        <tr>
            <td class="label"></td>
            <td><input type="submit" name="valid"></td>
        </tr>
    </table>
</form>

<ul id="retour">
    <ol id="return">
        <a href="index.php">Retour</a>
    </ol>
</ul>

<?php
include('footer.php');
?>