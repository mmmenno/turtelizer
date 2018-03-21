<?php

	$url = "https://api.data.adamlink.nl/datasets/AdamNet/all/services/endpoint/sparql?default-graph-uri=&query=" . urlencode($_POST['sparql']) . "&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on";
    
    $json = file_get_contents($url);

    $data = json_decode($json,true);
    //print_r($data);

    if(count($data['results']['bindings'])){
        
        foreach($data['results']['bindings'] as $row){

        	$titletext = '';
        	foreach ($row as $k => $v) {
        		if($k!="img" && $k!="uri"){
        			$titletext .= $k . ": " . $v['value'] . "\n";
        		}
        	}

        	echo '<div class="item">';
        	echo '<input type="checkbox" checked="checked" value="' . $row['uri']['value'] . '" />';
        	echo '<img src="' . $row['img']['value'] . '" title="' . $titletext . '" >';
        	echo "</div>";
        }
        
    }


?>