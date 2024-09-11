<!doctype html>
<html lang="de">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Regex-Tickets</title>
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #a1a1a1;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #8a8a8a;
        }

        a {
            color: black;
        }

        td {
            border-right: white 1px solid;
            border-left: white 1px solid;
        }
    </style>
</head>
<body class="overflow-hidden bg-light" style="height: 100vh">
    <div class="row" style="height: 100vh">
        <div class="col"></div>
        <div class="col-6 bg-white shadow">
            <h1 class="pt-3 pb-4">Regex-Tickets</h1>
            <div class="rounded border border-light" style="overflow-y: scroll; height: 85vh;">
                <table class="w-100">
                    <thead class="sticky-top bg-white">
                        <tr>
                            <th class="p-3">Kunde</th>
                            <th class="p-3">Titel</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Bearbeiter</th>
                            <th class="p-3">Link</th>
                        </tr>
                    </thead>
                    <?php for ($i = 0; $i < count($matches[1]); $i++) { ?>
                        <tr bgcolor="<?= $matches[1][$i] ?>" class="border border-light">
                            <td class="text-center p-3"><?= $matches[4][$i] ?></td>
                            <td class="p-3"><?= $matches[3][$i]." - ".$matches[7][$i] ?></td>
                            <td class="p-3"><?= $matches[5][$i] ?></td>
                            <td class="p-3"><?= $matches[6][$i] ?></td>
                            <td class="text-center p-3"><a href="https://tickets.fatchip.de<?= $matches[2][$i] ?>"><i class="bi bi-box-arrow-up-right"></i></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="col"></div>
    </div>
</body>
</html>
