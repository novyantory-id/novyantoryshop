<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <div>
        <h2>Akun Berhasil Diverifikasi</h2>
    </div>
    <div>
        <input type="hidden" name="user_id" value="<?= $user->id ?>">
    </div>
    <div>
        <p>Silahkan refresh untuk login!</p>
    </div>
</body>

</html>