<!-- register.php -->
<h2>Registreren</h2>
<form action="../views/process_register.php" method="POST">
    <label>Gebruikersnaam: <input type="text" name="username" required></label><br>
    <label>E-mail: <input type="email" name="email" required></label><br>
    <label>Wachtwoord: <input type="password" name="password" required></label><br>
    <button type="submit">Registreren</button>
</form>
<p>Heeft u al een account? <a href="index.php?page=login">Inloggen</a></p>
