<?php

namespace App\DataTables;

use App\CareerAbrecco;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CareerDataTable extends DataTable
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
        
        ->editColumn('name', function (CareerAbrecco $new) {
            return $new->name;
        })
        ->editColumn('email', function (CareerAbrecco $new) {
            return $new->email;
        })
        ->editColumn('phone', function (CareerAbrecco $new) {
            return $new->phone;
        })
        ->editColumn('created_at', function (CareerAbrecco $new) {
            return $new->created_at->format('d-m-Y h:i A');
        })
        ->editColumn('career_type', function (CareerAbrecco $new) {

            if(isset($new->career))
            {
                return $new->career->title;
            }
           
        })
        ->addColumn('action', function (CareerAbrecco $career) {
            return view('admin.career-enquries.action', compact('career'));
        })
        
        ->rawColumns(['name', 'email','phone','job']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\CareerDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CareerAbrecco $model)
    {
        return $model->with('career')->orderBy('created_at', 'desc')->newQuery();
       
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('careerdatatable-table')
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
            Column::make('email')->title(__('Email')),
            Column::make('career_type')->title(__('Job'))->name('career.title')->orderable(false),
            Column::make('phone')->title(__('Phone')),
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
    protected function filename()
    {
        return 'Career_' . date('YmdHis');
    }
}
