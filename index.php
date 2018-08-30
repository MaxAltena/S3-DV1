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
        <title>Datavisualisatie | Max Altena</title>
        <link href="http://static.maxaltena.com/web/font/Hind.css" rel="stylesheet">
        <link href="http://static.maxaltena.com/web/font/OpenSans.css" rel="stylesheet">
        <link href="http://static.maxaltena.com/web/css/default.css" rel="stylesheet">
        <script src="http://static.maxaltena.com/web/lib/jquery.min.js"></script>
        <script src="http://static.maxaltena.com/web/lib/d3.v5.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
            main {
                width: 100%;
                height: 100vh;
                display: grid;
                grid-template-columns: 50% 50%;
                grid-template-rows: 7vh 46.5vh 46.5vh;
                grid-template-areas: 
                    "headerTop headerTop"
                    "topLeft topRight"
                    "bottomLeft bottomRight";
                background: #202020;
            }
            .headerTop {
                grid-area: headerTop;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #DEDEDE;
            }
            .topLeft {
                grid-area: topLeft;
                width: 100%;
                height: 100%;
            }
            .topLeft #treechart {
                height: 46.5vh;
                width: 100%;
                margin-top: 10px;
                margin-left: 7px;
            }
            .topRight {
                grid-area: topRight;
                width: 100%;
                height: 100%;
            }
            .topRight #piechart {
                width: 98%;
                height: 100%;
            }
            .bottomLeft {
                grid-area: bottomLeft;
                width: 100%;
                height: 100%;
            }
            .bottomLeft iframe {
                width: 100%;
                height: 100%;
            }
            .bottomRight {
                grid-area: bottomRight;
                width: calc(100% - 100px);
                height: 100%;
                z-index: 10;
                position: relative;
                margin-left: 60px;
                margin-top: 30px;
            }
            .hover1 {
                position: absolute;
                top: 145;
                left: 90;
                color: #DEDEDE;
                font-size: 25px;
            }
            .hover2 {
                position: absolute;
                top: 125;
                left: 265;
                color: #DEDEDE;
                font-size: 25px;
            }
            .hover3 {
                position: absolute;
                top: 150;
                left: 455;
                color: #202020;
                font-size: 25px;
            }
        </style>
    </head>
    <body>
        <main>
            <h1 class="headerTop">De afvalbakken van gemeente Eindhoven</h1>
            <div class="topLeft">
                <div id="treechart"></div>
            </div>
            <div class="topRight">
                <div id="piechart"></div>
            </div>
            <div class="bottomLeft">
                <iframe src="https://data.eindhoven.nl/explore/embed/dataset/afvalbakken0/map/?location=11,51.43967,5.46295&basemap=jawg.light&static=false&datasetcard=false&scrollWheelZoom=true" frameborder="0"></iframe>
            </div>
            <div class="bottomRight">
                <img src="data:image/jpeg;base64,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" />
                <div class="hover1">1810</div>
                <img class="aligncenter wp-image-29342 size-medium" src="https://www.bammens.com/wp-content/uploads/2017/08/Capitole-L-159x300.png" alt="" width="159" height="300" srcset="https://www.bammens.com/wp-content/uploads/2017/08/Capitole-L-159x300.png 159w, https://www.bammens.com/wp-content/uploads/2017/08/Capitole-L-510x964.png 510w, https://www.bammens.com/wp-content/uploads/2017/08/Capitole-L-542x1024.png 542w, https://www.bammens.com/wp-content/uploads/2017/08/Capitole-L.png 705w" sizes="(max-width: 159px) 100vw, 159px">
                <div class="hover2">14</div>
                <img src="data:image/jpeg;base64,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" />
                <div class="hover3">232</div>
            </div>
        </main>   
        <script>
            $.getJSON("http://static.maxaltena.com/web/data/afvalbakken", function(data){
                console.log(data); // Output JSON data in console
                var i;
                var total = data.length;
                
                function getUniques(field){
                    var flags = [];
                    var array = [];
                    for(i=0; i<total; i++){
                        if(flags[data[i]['fields'][field]]) continue;
                        flags[data[i]['fields'][field]] = true;
                        array.push(data[i]['fields'][field]);
                    }
                    array = array.filter(function(value){
                       return value != undefined; 
                    });
                    return array;
                }
                
                function getCounts(unique_field, field){
                    var unique_counts = [];
                    $.each(unique_field, function(i, value) {
                        var thisCount = 0;
                        $.each(data, function(i2, value2) {
                            if (value === value2['fields'][field]) {
                                thisCount++;
                            };
                        });
                        unique_counts.push(thisCount);
                    });
                    return unique_counts;
                };
                
                var unique_stadsdeel = getUniques("stadsdeel");
                var count_stadsdeel = getCounts(unique_stadsdeel, "stadsdeel");
                var unique_buurt_code = getUniques("buurt_code");
                var count_buurt_code = getCounts(unique_buurt_code, "buurt_code");
                var unique_buurt = getUniques("buurt");
                var count_buurt = getCounts(unique_buurt, "buurt");
                var unique_straat = getUniques("straat");
                var count_straat = getCounts(unique_straat, "straat");
                var unique_kleur = getUniques("kleur");
                var count_kleur = getCounts(unique_kleur, "kleur");
                var unique_voet = getUniques("voet");
                var count_voet = getCounts(unique_voet, "voet");
                var unique_standplaat = getUniques("standplaat");
                var count_standplaat = getCounts(unique_standplaat, "standplaat");
                var unique_soort = getUniques("soort");
                var count_soort = getCounts(unique_soort, "soort");
                
                function createPieChart(){
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawPieChart);
                    function drawPieChart(){
                        var array = [['Kleur', 'Hoeveelheid']];
                        $.each(unique_kleur, function(i){
                            array.push([unique_kleur[i], count_kleur[i]]);
                        });
                        
                        var output = google.visualization.arrayToDataTable(array);
                        var options = {
                            title: 'Hoeveelheid verschillende kleuren',
                            backgroundColor: "#202020",
                            titleTextStyle: {color: "#DEDEDE"},
                            pieSliceTextStyle: {color: "#202020"},
                            legend: {textStyle: {color: "#DEDEDE"}},
                            height: 440,
                            width: 720,
                            pieHole: 0.4,
                            pieSliceBorderColor: "#202020",
                            sliceVisibilityThreshold: .1,
                            slices:{
                                0: {color: "green"},
                                1: {color: "gray"},
                                2: {color: "yellow"}
                            }
                        };
                        var pie = new google.visualization.PieChart($("#piechart")[0]);
                        google.visualization.events.addListener(pie, 'ready', changePieText);
                        pie.draw(output, options);
                    }
                }
                
                function changePieText(){
                    $("#piechart > div > div:nth-child(1) > div > svg > g:nth-child(4) > g:nth-child(5) > g > text").text("Ander");
                }
                
                function createTreeChart(){
                    google.charts.load('current', {'packages':['treemap']});
                    google.charts.setOnLoadCallback(drawTreeChart);
                    function drawTreeChart(){
                        var array = [['Stadsdeel', 'Parent', 'Grootte', 'Kleur'], ['Hoeveelheid per stadsdeel', null, 0, 0]];
                        $.each(unique_stadsdeel, function(i){
                            array.push([unique_stadsdeel[i], 'Hoeveelheid per stadsdeel', count_stadsdeel[i], getProcent(count_stadsdeel[i])]);
                        });
                        var data = google.visualization.arrayToDataTable(array);
                        var options = {
                            minColor: "#DEDEDE",
                            maxColor: "#FECD18",
                            fontColor: "#202020",
                            textStyle: { color: "#202020" },
                            width: 720,
                            height: 350,
                            maxDepth: 0,
                            highlightOnMouseOver: true
                        }
                        tree = new google.visualization.TreeMap($("#treechart")[0]);
                        tree.draw(data, options);
                    }
                }
                
                function getProcent(amount){
                    var result = (amount/total) * 100;
                    return result;
                }
                
                
                
                // Things left to do
                createTreeChart();
                createPieChart();
                
                // Output all data in a table under the dashboard
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
            
            $("#treechart").on("click", function(){
                var text = $("#treechart > div > div:nth-child(1) > div > svg > g > text").text();
                var index = unique_stadsdeel.indexOf(text);
                console.log(text);
                console.log(index);
                
                $("#treechart > div > div:nth-child(1) > div > svg > g > text").text(text + " " + count_stadsdeel[index])
            });
        </script>
    </body>
</html>