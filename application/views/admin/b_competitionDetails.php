<div class="row">
<div class="col-md-6 col-md-offset-3">

    <?php
    $ID = isset($ID) ? $ID : '';
    $competitionName = isset($competitionName) ? $competitionName : '';
    $competitionDiscription = isset($competitionDiscription) ? $competitionDiscription : '';
    $date = isset($date) ? $date : '';
    $days = isset($days) ? $days : '';
    $placeID = isset($placeID) ? $placeID : '1';

    $dataCompetitionName = array(
        'ID'          => 'competitionName',
        'name'        => 'competitionName',
        'type'        => 'text',
        'class'       => 'form-control',
        'value'       => $competitionName,
        'placeholder' => 'Введите название'
    );
    $dataCompetitionDiscription = array(
        'ID'          => 'competitionDiscription',
        'name'        => 'competitionDiscription',
        'value'       => $competitionDiscription,
        'class'       => 'form-control',
        'cols'        => '30',
        'rows'        => '3'
    );
    $dataDate = array(
        'ID'          => 'date',
        'name'        => 'date',
        'value'       => $date,
        'class'       => 'form-control',
        'type'        => 'date'
    );
    $dataDays = array(
        'ID'          => 'days',
        'name'        => 'days',
        'value'       => $days,
        'class'       => 'form-control',
        'type'        => 'number'
    );
    foreach($places as $value)
        $options[$value['ID']] = $value['Место'];
    $dataPlace = 'class = "form-control" ID ="place"';
    $dataPhoto = array(
        'ID'          => 'photoFile',
        'name'        => 'photoFile',
        'class'       => 'form-control',
        'type'        => 'file'
    );

    echo form_open('admincompetition/competitionEdit/'.$ID);
    echo '<div class="form-group">';
    echo form_label('Название соревнования', 'competitionName');
    echo form_input($dataCompetitionName);
    echo form_label('Описание соревнования', 'competitionDiscription');
    echo form_textarea($dataCompetitionDiscription);
    echo form_label('Дата', 'date');
    echo form_input($dataDate);
    echo form_label('Продолжительность, дней', 'days');
    echo form_input($dataDays);
    echo form_label('Место', 'place');
    echo form_dropdown('placeID', $options,$placeID,$dataPlace);
    echo form_label('Загрузить фото', 'photoFile');
    echo form_input($dataPhoto);
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