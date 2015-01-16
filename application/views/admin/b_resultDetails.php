<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
        $resultID = isset($resultID) ? $resultID : '';
        $segmentID = isset($segmentID) ? $segmentID : '';
        $sportsmenID = isset($sportsmenID) ? $sportsmenID : '';
        $technicalScore = isset($technicalScore) ? $technicalScore : '0';
        $componentScore = isset($componentScore) ? $componentScore : '0';
        $deduction = isset($deduction) ? $deduction : '0';

        foreach($sportsmens as $value)
            $optionsSportsmen[$value['ID']] = $value['Спортсмен'];
        $dataSportsmen = 'class = "form-control" ID ="$sportsmenID"';

        $dataTechnicalScore = array(
            'ID'          => 'technicalScore',
            'name'        => 'technicalScore',
            'value'       => $technicalScore,
            'class'       => 'form-control',
            'step'        => 'any',
            'type'        => 'number'
        );
        $dataComponentScore = array(
            'ID'          => 'componentScore',
            'name'        => 'componentScore',
            'value'       => $componentScore,
            'class'       => 'form-control',
            'step'        => 'any',
            'type'        => 'number'
        );
        $dataDeduction = array(
            'ID'          => 'deduction',
            'name'        => 'deduction',
            'value'       => $deduction,
            'class'       => 'form-control',
            'step'        => 'any',
            'type'        => 'number'
        );

        if($segmentID)
            echo anchor(site_url("admincompetition/segment/".$segmentID),'<- Назад к разряду');
        if($resultID)
            echo '<h1>ID Результата = '.$resultID.'</h1>';
        echo form_open('admincompetition/resultEdit/'.$segmentID.'/'.$resultID);
        echo '<div class="form-group">';

        echo form_label('Спортсмен', '$sportsmenID');
        echo form_dropdown('sportsmenID', $optionsSportsmen, $sportsmenID, $dataSportsmen);

        echo form_label('Сумма за элементы', 'technicalScore');
        echo form_input($dataTechnicalScore);

        echo form_label('Сумма за компоненты', 'componentScore');
        echo form_input($dataComponentScore);

        echo form_label('Снижения', 'deduction');
        echo form_input($dataDeduction);


        echo '</div>';

        echo '<button name="add" value="add" class="btn btn-success btn-block">Добавить</button>';
        echo '<button name="refresh" value="refresh" class="btn btn-warning btn-block">Обновить</button>';
        echo '<button name="delete" value="delete" class="btn btn-danger btn-block">Удалить</button>';
        echo form_close();
        ?>
    </div>
    <div class="col-md-offset-3">
    </div>
</div>