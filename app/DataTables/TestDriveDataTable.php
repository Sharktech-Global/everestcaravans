<?php

namespace App\DataTables;

use App\TestDriveEnquiry;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestDriveDataTable extends DataTable
{
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

            ->editColumn('name', function (TestDriveEnquiry $new) {
                return $new->name;
            })
            ->editColumn('phone', function (TestDriveEnquiry $new) {
                return $new->phone;
            })

            ->editColumn('vehicle_id', function (TestDriveEnquiry $new) {

                if (isset($new->vehicle)) {
                    return $new->vehicle->name;
                }
            })
            ->editColumn('location_id', function (TestDriveEnquiry $new) {

                if (isset($new->location)) {
                    return $new->location->name;
                }
            })
            // ->editColumn('email', function (TestDriveEnquiry $new) {
            //     return $new->email;
            // })
            ->editColumn('created_at', function (TestDriveEnquiry $new) {
                return $new->created_at->format('d-m-Y h:i A');
            })
            ->addColumn('action', function (TestDriveEnquiry $testdrive) {
                return view('admin.test-drive-enquries.action', compact('testdrive'));
            })
            ->rawColumns(['name', 'phone', 'vehicle_id', 'location_id', 'created_at', 'email']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\TestDriveDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TestDriveEnquiry $model)
    {
        return $model->with('vehicle', 'location')->orderBy('created_at', 'desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('testdrivedatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1);
        // ->buttons(
        //     Button::make('create'),
        //     Button::make('export'),
        //     Button::make('print'),
        //     Button::make('reset'),
        //     Button::make('reload')
        // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('Sl No'))->searchable(false)->orderable(false),
            Column::make('name')->title(__('Name')),
            Column::make('phone')->title(__('Phone')),
            Column::make('vehicle_id')->title(__('Model'))->name('vehicle.name')->orderable(false),
            Column::make('location_id')->title(__('Location'))->name('location.name')->orderable(false),
            // Column::make('email')->title(__('Email')),
            Column::make('created_at')->title('Created'),
            Column::computed('action')
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
    protected function filename(): string
    {
        return 'TestDrive_' . date('YmdHis');
    }
}
