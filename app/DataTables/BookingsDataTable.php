<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use App\DataTables\BaseDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\StadiumBooking;
use Carbon\Carbon;

class BookingsDataTable extends BaseDataTable
{
    private $deleteOrderPermission;
    private $editOrderPermission;
    private $viewOrderPermission;


    public function __construct()
    {
        parent::__construct();
        $this->viewOrderPermission = user()->permission('order.view');
        $this->deleteOrderPermission = user()->permission('order.delete');
        $this->editOrderPermission = user()->permission('order.edit');

        
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'total', 'name', 'order_number']);
    }

    public function ajax()
    {
        return $this->dataTable($this->query())
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $request = $this->request();
        $model = StadiumBooking::all();

        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('bookings-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->destroy(true)
                    ->responsive(true)
                    ->serverSide(true)
                    ->stateSave(true)
                    ->processing(true)
                    ->dom($this->domHtml)

                    ->language(__('app.datatable'))
                    ->parameters([
                        'initComplete' => 'function () {
                            window.LaravelDataTables["bookings-table"].buttons().container()
                            .appendTo( "#table-actions")
                        }',
                        'fnDrawCallback' => 'function( oSettings ) {
                            $("body").tooltip({
                                selector: \'[data-toggle="tooltip"]\'
                            });
                            $(".select-picker").selectpicker();

                        }',
                    ])
                    ->buttons(Button::make(['extend' => 'excel', 'text' => '<i class="fa fa-file-export"></i> ' . trans('app.exportExcel')]));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            __('app.id') => ['data' => 'id', 'name' => 'id', 'visible' => false, 'title' => __('app.id')],
            __('app.order') . __('app.no') => ['data' => 'order_number_export', 'name' => 'order_number_export', 'visible' => false, 'title' => __('app.order') . ' ' . __('app.no')],
            __('app.order') . '#' => ['data' => 'order_number', 'name' => 'order_number', 'exportable' => false, 'title' => __('app.order') . '#'],
            __('app.client_name') => ['data' => 'client_name', 'name' => 'project.client.name', 'visible' => false, 'title' => __('app.client_name')],
            __('app.client') => ['data' => 'name', 'name' => 'project.client.name', 'visible' => !in_array('client', user_roles()), 'exportable' => false, 'title' => __('app.client')],
            __('modules.invoices.total') => ['data' => 'total', 'name' => 'total', 'class' => 'text-right', 'title' => __('modules.invoices.total')],
            __('modules.orders.orderDate') => ['data' => 'order_date', 'name' => 'order_date', 'title' => __('modules.orders.orderDate')],
            __('app.status') => ['data' => 'status', 'name' => 'status', 'width' => '10%', 'exportable' => false, 'title' => __('app.status')],
            __('order_status') => ['data' => 'order_status', 'name' => 'order_status', 'width' => '10%', 'visible' => false, 'title' => __('app.status')],
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(150)
                ->addClass('text-right pr-20')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Bookings_' . date('YmdHis');
    }

    public function pdf()
    {
        set_time_limit(0);

        if ('snappy' == config('datatables-buttons.pdf_generator', 'snappy')) {
            return $this->snappyPdf();
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('datatables::print', ['data' => $this->getDataForPrint()]);

        return $pdf->download($this->getFilename() . '.pdf');
    }
}
