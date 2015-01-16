<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
        $competitionID = isset($competitionID) ? $competitionID : '';
        $segmentID = isset($segmentID) ? $segmentID : '';
        $categoryID = isset($categoryID) ? $categoryID : '1';
        $groupNum = isset($groupNum) ? $groupNum : '0';
        $programTypeID = isset($programTypeID) ? $programTypeID : '1';
        $gender = isset($gender) ? $gender : '0';

        foreach($categories as $value)
            $optionsCategory[$value['ID']] = $value['Разряд'];
        $dataCategory = 'class = "form-control" ID ="categoryID"';

        $dataGroupNum = array(
            'ID'          => 'groupNum',
            'name'        => 'groupNum',
            'value'       => $groupNum,
            'class'       => 'form-control',
            'type'        => 'number'
        );

        foreach($programs as $value)
            $optionsPrograms[$value['ID']] = $value['Программа'];
        $dataPrograms = 'class = "form-control" ID ="programTypeID"';

        $optionsGender['0'] = 'Ж';
        $optionsGender['1'] = 'М';
        $dataGender = 'class = "form-control" ID ="gender"';
        if($competitionID)
            echo anchor(site_url("admincompetition/competition/".$competitionID),'<- Назад к соревнованию');
        if($segmentID)
            echo '<h1>ID Сегмента = '.$segmentID.'</h1>';
        echo form_open('admincompetition/segmentEdit/'.$competitionID.'/'.$segmentID);
        echo '<div class="form-group">';
        echo form_label('Разряд', 'categoryID');
        echo form_dropdown('categoryID', $optionsCategory,$categoryID,$dataCategory);
        echo form_label('Группа', 'groupNum');
        echo form_input($dataGroupNum);
        echo form_label('Программа', 'programTypeID');
        echo form_dropdown('programTypeID', $optionsPrograms,$programTypeID,$dataPrograms);
        echo form_label('Пол', 'gender');
        echo form_dropdown('gender', $optionsGender,$gender,$dataGender);
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