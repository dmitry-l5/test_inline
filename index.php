<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/index.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="" id="page">
        <div class="form" id="filter">
            <form id="find_form">
                <label for="find">Поиск : </label>
                <input type="text" id="find" name="find">
                <button type="submit" onclick="find_request(event, find_form)">Найти</button>
            </form>
        </div>
        <div class="" id="dashboard">
        </div>
    </div>
    <script>
        document.addEventListener('post_updated', function(){redraw_dashboard(dashboard)});
    </script>
</body>
</html>