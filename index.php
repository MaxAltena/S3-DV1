<?php
    
    function include_url($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    
?>
<html lang="nl">
    <head>
        <?= include_url('http://static.maxaltena.com/web/favicon'); ?>
        <meta charset="UTF-8">
        <link href="http://static.maxaltena.com/web/font/Hind.css" rel="stylesheet">
        <link href="http://static.maxaltena.com/web/font/OpenSans.css" rel="stylesheet">
        <link href="http://static.maxaltena.com/web/css/default.css" rel="stylesheet">
        <script src="http://static.maxaltena.com/web/lib/jquery.min.js"></script>
        <meta charset="UTF-8">
        <title>Datavisualisatie | Max Altena</title>
    </head>
    <body>
        <h1>Afvalbakken!</h1>
        <script>
            $.getJSON("http://static.maxaltena.com/web/data/afvalbakken", function(data){
                console.log(data); // Output JSON data in console

                var items = [];
                items.push("<tr id='tableHeader'><th>Stadsdeel</th><th>Buurt</th><th>Straat</th><th>Soort</th><th>Kleur</th></tr>");
                $.each(data, function(key, val){
                    items.push("<tr id='"+key+"'><td>"+val['fields']['stadsdeel']+"</td><td>"+val['fields']['buurt']+"</td><td>"+val['fields']['straat']+"</td><td>"+val['fields']['soort']+"</td><td>"+val['fields']['kleur']+"</td></tr>");
                    items[key] = items[key].replace(/\undefined/g, '');
                    
                    
                });
                
                $("<table/>", {
                    html: items.join("")
                }).appendTo("body");
            });
        </script>
    </body>
</html>
