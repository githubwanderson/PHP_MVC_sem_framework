<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
    
    <title><?php echo $title ?></title>
</head>
<body>
    <div class="container">
        <section id="header">
            <ul id="nav">
                <li><a href="/">Início</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
            <div>
                Bem vindo, visitante.
            </div>
        </section>
   
        <?php require VIEW_PATH . $this->controller->view; ?>
    </div>
</body>
</html>
