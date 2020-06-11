<?php

namespace App\DataTables;

use App\Admin;
//use App\AdminDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;

class AdminDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.admins.btn.checkbox')
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
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
     * @param \App\AdminDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AdminDatatable $model)
    {
        //return $model->newQuery();
        return Admin::query()->whereNotIn('status', [-1]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('admindatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu([[10, 25, 50, 100], [10, 25, 50, __('admin.all_record')]])
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->className('btn btn-info'),
                        //Button::make('remove'),
                        Button::make('print')->className('btn btn-primary'),
                        Button::make('csv')->className('btn btn-info'),
                        Button::make('excel')->className('btn btn-success'),
                        //Button::make('reset')->className('btn btn-default'),
                        Button::make('reload')->className('btn btn-default'),
                        Button::make('delete')->className('btn btn-danger deleteBtn'),

                    )
                    ->parameters([
                        'initComplete' => 'function () {
                            this.api().columns([2, 3, 4]).every(function () {
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
                          "sProcessing" => __("admin.sProcessing"),
                          "sLengthMenu" => __("admin.sLengthMenu"),
                          "sZeroRecords" => __("admin.sZeroRecords"),
                          "sEmptyTable" => __("admin.sEmptyTable"),
                          "sInfo" => __("admin.sInfo"),
                          "sInfoEmpty" => __("admin.sInfoEmpty"),
                          "sInfoFiltered" => __("admin.sInfoFiltered"),
                          "sInfoPostFix" => __("admin.sInfoPostFix"),
                          "sSearch" => __("admin.sSearch"),
                          "sUrl" => __("admin.sUrl"),
                          "sInfoThousands" => __("admin.sInfoThousands"),
                          "sLoadingRecords" => __("admin.sLoadingRecords"),
                          "oPaginate" => [
                              "sFirst" => __("admin.sFirst"),
                              "sLast" => __("admin.sLast"),
                              "sNext" => __("admin.sNext"),
                              "sPrevious" => __("admin.sPrevious")
                          ],
                          "oAria" => [
                              "sSortAscending" => __("admin.sSortAscending"),
                              "sSortDescending" => __("admin.sSortDescending")
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
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('edit')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::computed('delete')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}
