<?php

namespace App\DataTables;

use App\Country;
use App\City;
use App\State;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;

class StatesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'admin.states.btn.checkbox')
            ->addColumn('edit', 'admin.states.btn.edit')
            ->addColumn('delete', 'admin.states.btn.delete')
            ->editColumn('created_at', function ($contact){
                return date('Y-m-d H:i', strtotime($contact->created_at) );
            })
            ->editColumn('updated_at', function ($contact){
                return date('Y-m-d H:i', strtotime($contact->updated_at) );
            })
            ->rawColumns([
                'checkbox', 'edit', 'delete'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\StatesDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CitiesDatatable $model)
    {
        //return $model->newQuery();
        return State::query()->with('country')->with('city')->whereNotIn('status', [-1]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('statedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu([[10, 25, 50, 100], [10, 25, 50, __('all_record')]])
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->className('btn btn-info'),
                        //Button::make('remove'),
                        Button::make('print')->className('btn btn-primary'),
                        Button::make('csv')->className('btn btn-info'),
                        Button::make('excel')->className('btn btn-success'),
                        //Button::make('reset')->className('btn btn-default'),
                        Button::make('reload')->className('btn btn-default'),
                        Button::make('delete')->className('btn btn-danger deleteBtn')
                    )
                    ->parameters([
                        'initComplete' => 'function () {
                            this.api().columns([2, 3]).every(function () {
                                var column = this;
                                var input = document.createElement("input");
                                $(input).appendTo($(column.footer()).empty())
                                .on(\'keyup\', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }',
                        // include language translation of data table
                        'language' => [
                            "sProcessing" => __("sProcessing"),
                            "sLengthMenu" => __("sLengthMenu"),
                            "sZeroRecords" => __("sZeroRecords"),
                            "sEmptyTable" => __("sEmptyTable"),
                            "sInfo" => __("sInfo"),
                            "sInfoEmpty" => __("sInfoEmpty"),
                            "sInfoFiltered" => __("sInfoFiltered"),
                            "sInfoPostFix" => __("sInfoPostFix"),
                            "sSearch" => __("sSearch"),
                            "sUrl" => __("sUrl"),
                            "sInfoThousands" => __("sInfoThousands"),
                            "sLoadingRecords" => __("sLoadingRecords"),
                            "oPaginate" => [
                                "sFirst" => __("sFirst"),
                                "sLast" => __("sLast"),
                                "sNext" => __("sNext"),
                                "sPrevious" => __("sPrevious")
                            ],
                            "oAria" => [
                                "sSortAscending" => __("sSortAscending"),
                                "sSortDescending" => __("sSortDescending")
                            ]
                        ]
                        /**
                        * another way to include language translation of data table using route url
                        */
                        // 'language' => [
                        //     "url" => url(adminURL("dataTable/lang"))
                        // ]
                    ])
                    ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
              'name'        => 'checkbox',
              'data'        => 'checkbox',
              'title'       => '<input type="checkbox" class="check_all" onclick="check_all()"/>',
              'exportable'  => false,
              'printable'   => false,
              'searchable'  => false,
              'orderable'   => false,

            ],
//            [
//              'name'        => 'id',
//              'data'        => 'id',
//              'title'       => '#'
//            ],
            [
              'name'        => 'state_name_ar',
              'data'        => 'state_name_ar',
              'title'       => __('name_ar'),
              'class'       => 'text-center',
            ],
            [
              'name'        => 'state_name_en',
              'data'        => 'state_name_en',
              'title'       => __('name_en'),
              'class'       => 'text-center',
            ],
            [
              'name'        => 'country.country_name_'.session('lang'),
              'data'        => 'country.country_name_'.session('lang'),
              'title'       => __('country'),
              'class'       => 'text-center',
            ],
            [
              'name'        => 'city.city_name_'.session('lang'),
              'data'        => 'city.city_name_'.session('lang'),
              'title'       => __('city'),
              'class'       => 'text-center',
            ],
            [
              'name'        => 'created_at',
              'data'        => 'created_at',
              'title'       => __('created_at'),
              'class'       => 'text-center',
            ],
            [
              'name'        => 'updated_at',
              'data'        => 'updated_at',
              'title'       => __('updated_at'),
              'class'       => 'text-center',
            ],
            [
              'name'        => 'edit',
              'data'        => 'edit',
              'title'       => __('edit'),
              'class'       => 'text-center',
              'exportable'  => false,
              'printable'   => false,
              'searchable'  => false,
              'orderable'   => false,

            ],
            [
              'name'        => 'delete',
              'data'        => 'delete',
              'title'       => __('delete'),
              'class'       => 'text-center',
              'exportable'  => false,
              'printable'   => false,
              'searchable'  => false,
              'orderable'   => false,

            ],
            // Column::computed('edit')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            // Column::computed('delete')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'State_' . date('YmdHis');
    }
}
