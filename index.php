<?php

//Check of er iets is ingevuld
if (!empty($_POST)) {

	//Het laden van LootjesTrekken.php
	require ('LootjesTrekken.php');

	$lootjestrekken = new LootjesTrekken();
	$lootjestrekken->run();

	die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<style type='text/css'>
	</style>
	<script type='text/javascript'>

        var tmp_dom = null;
        var counter = 1;
        function addUser(){
            //Store tmp object for creation of more (if one isnt already stored)
            if(tmp_dom == null) tmp_dom = document.getElementById('insert_zone').children[0];

            //Create new node
            new_node = tmp_dom.cloneNode(true);
            //Blank inputs and update form ID's
            inputs = new_node.getElementsByTagName('input')
            for(var i=0; i<inputs.length; i++){
                inputs[i].value ='';
                inputs[i].name = inputs[i].name.slice(0, -1)+counter;
            }
            //Add new row
            document.getElementById('insert_zone').appendChild(new_node);
            counter++; document.getElementById('count').value = counter;
  
            return false;
        }
        function removeRow(me){
            //Store so we can add new ones (assumings its not already there)
            if(tmp_dom == null) tmp_dom = document.getElementById('insert_zone').children[0];
            document.getElementById('insert_zone').removeChild(me.parentNode);
        }
	</script>
</head>
<body>
	<form method='post' action=''>
			<h1>Lootjes trekken</h1>
			<h3>Personen toevoegen</h3>
			<div id='insert_zone'>
				<div class='row'>
					Naam<input name='user_name_0' value='' />
					<span onclick='removeRow(this);'>[x]</span>
				</div>
			</div>
				<button onclick='return addUser();'>Add another User</button>
		<input type='hidden' id='count' name='count' value='0' />

		<input type='submit'/>
	</form>
</body>
</html>