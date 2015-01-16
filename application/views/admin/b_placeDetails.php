<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <?php

    $ID = isset($ID) ? $ID : '';
    $name = isset($name) ? $name : '';
    $dataName = array(
        'ID'          => 'name',
        'name'        => 'name',
        'type'        => 'text',
        'class'       => 'form-control',
        'value'       => $name,
        'placeholder' => 'Введите имя'
    );


    echo form_open('adminplaces/placeEdit/'.$ID);
    echo '<div class="form-group">';
    echo form_label('Город', 'name');
    echo form_input($dataName);
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