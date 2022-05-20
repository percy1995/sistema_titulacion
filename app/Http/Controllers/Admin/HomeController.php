<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Nota',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Traplipro',
            'group_by_field'     => 'nota',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'translation_key'    => 'traplipro',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Asesoria',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Monitoreo',
            'group_by_field'     => 'dni',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '30',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'docente',
            'translation_key'    => 'monitoreo',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'        => 'Trabajo Aplicacion Profesional',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Traplipro',
            'group_by_field'     => 'nota',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '14',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'translation_key'    => 'traplipro',
        ];

        $chart3 = new LaravelChart($settings3);

        $settings4 = [
            'chart_title'        => 'Programas Modulares',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Traplipro',
            'group_by_field'     => 'nombreprograma',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '14',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'programamodular',
            'translation_key'    => 'traplipro',
        ];

        $chart4 = new LaravelChart($settings4);

        return view('home', compact('chart1', 'chart2', 'chart3', 'chart4'));
    }
}
