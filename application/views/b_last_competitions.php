<div class="block-last-competitions">
    <h1>Последние соревнования</h1>
    <?php
    $i = 0;
    foreach($competitions as $row)
    {
        if(!is_null($row['image']))
            $img_tag = img($row['image']);
        else
            $img_tag = img('img/null-competition.jpg');
        $compList[$i] = anchor('competition/info/'.$row['ID'], $img_tag.$row['name']);
        $i++;
    }
    echo ul($compList);
    ?>
</div>