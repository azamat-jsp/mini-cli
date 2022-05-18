<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Bootstrap demo</title>
</head>
<body id="body">
<div class="container">
    <div id="redisData" class="row">
        <ul id="redisUl">

        </ul>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script>
    fetch('/api/redis')
        .then(response => response.json())
        .then(res => {
            let data = JSON.parse(res.data)
            if (data.status && data.code === 200) {
                let redisDataElement = document.getElementById('redisData');
                Object.keys(data.data).forEach((element) => {
                    let key = data.data[element];
                    redisDataElement.innerHTML += `<div class="col-3" id="item_${element}"><li>${element} : ${key} <a href="#" onclick='removeItem("${element}")'> delete</a></li></div>`;
                });
            }
        })

    function removeItem(key)
    {
        let element = document.getElementById("item_" + key);
        return fetch(`/api/redis/${key}`, {
            method: 'DELETE',
            body: `${key}`
        }).then(response => {
            if(response.status === 200) {
                element.remove()
            }
        })
    }
</script>
</body>
</html>
