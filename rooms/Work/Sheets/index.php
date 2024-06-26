<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Spreadsheet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@8.3.2/dist/handsontable.full.min.css">
    <script src="https://cdn.jsdelivr.net/npm/handsontable@8.3.2/dist/handsontable.full.min.js"></script>
</head>
<body>
    <div id="spreadsheet"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('spreadsheet');

            fetch('api/index.php')
                .then(response => response.json())
                .then(data => {
                    const hot = new Handsontable(container, {
                        data: data.data,
                        rowHeaders: true,
                        colHeaders: true,
                        contextMenu: true,
                        afterChange: (changes, source) => {
                            if (source !== 'loadData') {
                                fetch('api/index.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ data: hot.getData() })
                                });
                            }
                        }
                    });
                });
        });
    </script>
</body>
</html>
