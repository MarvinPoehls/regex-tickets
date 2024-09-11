<?php

function getRequestParameter($key, $default = null) {
    if (isset($_REQUEST[$key])) {
        $value = trim($_REQUEST[$key]);

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $default;
}

?>
<!doctype html>
<html lang="de">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body class="bg-light">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <div class="p-5 mt-5 rounded bg-white shadow">
                    <?php if (getRequestParameter('error')) { ?>
                        <div class="alert alert-danger mb-5"><?= getRequestParameter('error'); ?></div>
                    <?php } ?>
                    <form action="index.php" method="post">
                        <h1 class="mb-4">Regex-Tickets Login</h1>
                        <div class="alert alert-info">Bitte melde dich mit den Daten aus dem Ticket-System an.</div>
                        <label for="username" class="text-secondary">Benutzername</label>
                        <input type="text" name="username" class="form-control mb-4" id="username">
                        <label for="password" class="text-secondary">Passwort</label>
                        <input type="password" name="password" class="form-control mb-4" id="password">
                        <button type="submit" class="btn btn-primary">Anmelden</button>
                    </form>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>
