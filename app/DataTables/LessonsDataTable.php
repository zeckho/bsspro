<?php

namespace App\DataTables;

use App\Lesson;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LessonsDataTable extends DataTable
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
            ->editColumn('course', function($query){
                return $query->course->name;
            })
            ->editColumn('trainer', function($query){
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
                return view('lessons.action', compact('query'));
            })
            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\LessonsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Lesson $model)
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
                    ->setTableId('lessonsdatatable-table')
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
            Column::make('title'),
            Column::computed('course'),
            Column::computed('trainer'),
            Column::make('created_at'),
            Column::computed('status'),
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
        return 'Lessons_' . date('YmdHis');
    }
}
