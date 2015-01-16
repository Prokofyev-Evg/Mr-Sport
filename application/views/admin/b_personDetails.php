<div class="row">
    <div class="col-md-6 col-md-offset-3">

    <?php

    $ID = isset($ID) ? $ID : '';
    $fName = isset($fName) ? $fName : '';
    $lName = isset($lName) ? $lName : '';
    $birthDate = isset($birthDate) ? $birthDate : '';
    $actionID = isset($actionID) ? $actionID : '1';
    $placeID = isset($placeID) ? $placeID : '1';
    $genderMen = isset($genderMen) ? $genderMen : 0;

    $dataFirstName = array(
        'ID'          => 'fName',
        'name'        => 'fName',
        'type'        => 'text',
        'class'       => 'form-control',
        'value'       => $fName,
        'placeholder' => 'Введите имя'
    );
    $dataLastName = array(
        'ID'          => 'lName',
        'name'        => 'lName',
        'type'        => 'text',
        'class'       => 'form-control',
        'value'       => $lName,
        'placeholder' => 'Введите фамилию'
    );
    $dataBirthDate = array(
        'ID'          => 'birthDate',
        'name'        => 'birthDate',
        'value'       => $birthDate,
        'class'       => 'form-control',
        'type'        => 'date'
    );
    foreach($places as $value)
        $optionsPlaces[$value['ID']] = $value['Место'];
    $dataPlace = 'class = "form-control" ID ="placeID" name="placeID"';
    foreach($actions as $value)
        $optionsActions[$value['ID']] = $value['Место'];
    $dataAction = 'class = "form-control" ID ="actionID" name="actionID"';
    $dataPhoto = array(
        'ID'          => 'photoFile',
        'name'        => 'photoFile',
        'class'       => 'form-control',
        'type'        => 'file'
    );
    $dataGender = 'class = "form-control" ID ="genderMen"';
    $optionsGenderMen = array(
        '0'          => 'Ж',
        '1'          => 'М'
    );


    echo form_open('adminpersons/personEdit/'.$ID);
    echo '<div class="form-group col-md-6">';
    echo form_label('Имя', 'fName');
    echo form_input($dataFirstName);
    echo form_label('Дата рождения', 'birthDate');
    echo form_input($dataBirthDate);
    echo form_label('Город', 'place');
    echo form_dropdown('placeID', $optionsPlaces,$placeID,$dataPlace);
    echo '</div>';

    echo '<div class="form-group col-md-6">';
    echo form_label('Фамилия', 'lName');
    echo form_input($dataLastName);
    echo form_label('Пол', 'genderMen');
    echo form_dropdown('genderMen', $optionsGenderMen,$genderMen,$dataGender);
    echo form_label('Деятельность', 'action');
    echo form_dropdown('actionID', $optionsActions,$actionID,$dataAction);
    echo '</div>';

    echo '<div class="form-group">';
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