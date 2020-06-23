<?php

namespace App\DataTables;

use App\Course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
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
            ->editColumn('user', function($query){
                return $query->user->name;
            })
            ->editColumn('status', function($query){
                if ($query->status == 'enable') {
                    return "<span class='badge badge-pill badge-primary'>".$query->status."</span>";
                } else {
                    return "<span class='badge badge-pill badge-danger'>".$query->status."</span>";
                }
            })
            ->addColumn('action', function($query){
                return view('courses.action', compact('query'));
            })
            ->editColumn('started_at', function($query){
                return $query->started_date;
            })
            ->editColumn('finish_at', function($query){
                return $query->finish_date;
            })
            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\CoursesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Course $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('coursesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::computed('user'),
            Column::make('started_at'),
            Column::make('finish_at'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
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
        return 'Courses_' . date('YmdHis');
    }
}
