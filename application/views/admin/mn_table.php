<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?php
        $tmpl = array (
            'table_open'          => '<table class="table table-condensed table-hover">',
            'heading_cell_start'  => '<th>',
            'heading_row_start'   => '<tr class="info">'
        );
        if(isset($table[0]))
        {
            $this->table->set_heading(array_keys($table[0]));
            $this->table->set_template($tmpl);
            echo $this->table->generate($table);

            if(isset($config))
                $this->pagination->initialize($config);

            echo $this->pagination->create_links();
        }
        else
        {
            echo('<div class="alert alert-info" role="alert">
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            <span class="sr-only">Не найдено ни одной записи</span>
                Не найдено ни одной записи, может самое время добавить?
                </div>');
        }
        ?>
    </div>
    <div class="col-md-10 col-md-offset-1">
    </div>
</div>
