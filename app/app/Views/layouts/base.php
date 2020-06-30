<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DASHBOARD</title>
    <link href="<?=getenv('DOMAIN') ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=getenv('DOMAIN') ?>/assets/bootstrap/dashboard/dashboard.css" rel="stylesheet">
    <link href="<?=getenv('DOMAIN') ?>/assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <?php if (!empty($body)) { echo $body; } ?>
    <script src="<?=getenv('DOMAIN') ?>/assets/js/jquery.min.js"></script>
    <script src="<?=getenv('DOMAIN') ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="<?=getenv('DOMAIN') ?>/assets/bootstrap/dashboard/dashboard.js"></script>
    <script src="<?=getenv('DOMAIN') ?>/assets/js/custom.js"></script>
</body>
</html>