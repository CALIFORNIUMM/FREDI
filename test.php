<?php

$tab_a=array(
    "0"=>"--Please choose an option--",
    "1"=>"foot",
    "2"=>"judo",
);

$p2=array(
    "0"=> array("0"=>"--Please choose an option--"),
    "1"=> array("1"=>"foot1","2"=>"foot2","3"=>"foot3","4"=>"foot4"),
    "2"=> array("1"=>"judo1","2"=>"judo2","3"=>"judo3","4"=>"judo4")
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>test selector</h1>

    <form action="#">

    <label for="a">a</label><br>
    <select name="a" id="a" onchange="changeSelect(this);">
        <?php
            foreach($tab_a as $key=>$val){
                echo '<option value="'.$key.'">'.$val.'</option>';
            }
        ?>
    </select><br><br>

    <label for="b">b</label><br>
    <select name="b" id="b">
        <option value=""selected>--Please choose an option--</option>
    </select><br><br>

    <input type="submit" value="envoyer" name="submit">

    </form>

    <script>
     
    function changeSelect(selected){
        //on recupere le php
        var data = <?php echo json_encode($p2); ?>;
        
        console.log(data[selected.value]);
        var list = "";
        
        //on remplit le 2e select
        for (let [key, val] of Object.entries(data[selected.value])){
            list += '<option value="'+key+'">'+val+'</option>';
        }
        document.getElementById("b").innerHTML = list;
        console.log("list : "+list);
    }
    </script>
</body>
</html>