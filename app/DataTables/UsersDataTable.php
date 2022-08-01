<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Models\Role;
use App\DataTables\BaseDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\User;
use Carbon\Carbon;

class UsersDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $roles = Role::where('name', '<>', 'Customer')->get();
        return datatables()
            ->eloquent($query)
            ->addColumn('check', function ($row) {
                if ($row->id != 1 && $row->id != user()->id) {
                    return '<input type="checkbox" class="select-table-row" id="datatable-row-' . $row->id . '"  name="datatable_ids[]" value="' . $row->id . '" onclick="dataTableRowCheck(' . $row->id . ')">';
                }

                return '--';
            })
            ->editColumn('current_role_name', function ($row) use ($roles) {
                $userRole = $roles->pluck('name')->toArray();

                if (in_array('Super', $userRole)) {
                    return __('app.admin');

                } else {
                    return $userRole->name;
                }
            })
            ->addColumn('role', function ($row) use ($roles) {
                $userRole = $roles->pluck('name')->toArray();

                if (in_array('Super', $userRole)) {
                    return __('messages.roleCannotChange');
                }

                if ($row->id == user()->id || $row->id == 1) {
                    return __('messages.roleCannotChange');
                }

                $role = '<select class="form-control select-picker assign_role" data-user-id="' . $row->id . '">';

                foreach ($roles as $item) {
                    if (
                        $item->name != 'Super')
                        {

                        $role .= '<option ';

                        if (
                            (in_array($item->name, $userRole) && $item->name == 'Super')
                            || (in_array($item->name, $userRole) && !in_array('Super', $userRole))
                            ) {
                            $role .= 'selected';
                        }

                        $role .= ' value="' . $item->id . '">' . (($item->id <= 3) ? $item->name : $item->name) . '</option>';

                    }
                }

                $role .= '</select>';
                return $role;
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex align-items-center">
                                <div class="dropdown dropdown-default dropdown-text dropdown-icon-item">
                                    <button class="option-btn-1" type="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a id="dropdownMenuLink-' . $row->id . '" href="' . route('user.show', [$row->id]) . '" class="task_view_more dropdown-item"><i
                                                class="fa-regular fa-address-card me-3"></i>' . __('app.view') . '</a>';


                
                $action .= '<a class="dropdown-item openRightModal" href="' . route('user.edit', [$row->id]) . '">
                            <i class="fa fa-edit mr-2"></i>
                            ' . trans('app.edit') . '
                        </a>';
                
                
                if (user()->id !== $row->id) {
                    $action .= '<a class="dropdown-item delete-table-row" href="javascript:;" data-user-id="' . $row->id . '">
                            <i class="fa fa-trash mr-2"></i>
                            ' . trans('app.delete') . '
                        </a>';
                }
                

                $action .= '</div>
                    </div>
                </div>';

                return $action;
            })
            ->addColumn('employee_name', function ($row) {
                return $row->first_name.''.$row->last_name;
            })
            ->editColumn(
                'created_at',
                function ($row) {
                    return Carbon::parse($row->created_at)->format($this->global->date_format);
                }
            )
            ->editColumn(
                'status',
                function ($row) {
                    if ($row->status == 1) {
                        return ' <span class="status-circle green-circle"></span>' . __('app.active');
                    }
                    else {
                        return '<span class="status-circle red-circle"></span>' . __('app.inactive');
                    }
                }
            )
            ->editColumn('name', function ($row) {
                return $row->first_name.''.$row->last_name;
            })
            ->addIndexColumn()
            ->setRowId(function ($row) {
                return 'row-' . $row->id;
            })
            ->rawColumns(['name', 'action', 'role', 'status', 'check'])
            ->removeColumn('roleId')
            ->removeColumn('roleName')
            ->removeColumn('current_role');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $request = $this->request();

        $userRoles = '';

        if ($request->role != 'all' && $request->role != '') {
            $userRoles = Role::findOrFail($request->role);
        }

        $users = $model->newQuery();

        if ($request->status != 'all' && $request->status != '') {
 
            $users = $users->where('users.status', $request->status); 
        }

        if ($request->employee != 'all' && $request->employee != '') {
            $users = $users->where('users.id', $request->employee);
        }

        if ($request->designation != 'all' && $request->designation != '') {
            $users = $users->where('employee_details.designation_id', $request->designation);
        }

        if ($request->role != 'all' && $request->role != '' && $userRoles) {
            if ($userRoles->name == 'Super') {
                $users = $users->where('roles.id', $request->role);
            }
            /*elseif ($userRoles->name == 'Admin') {
                $users = $users->where(DB::raw('(select user_roles.role_id from role_user as user_roles where user_roles.user_id = users.id ORDER BY user_roles.role_id DESC limit 1)'), $request->role)
                    ->having('roleName', '<>', 'Admin');
            }
            else {
                $users = $users->where(DB::raw('(select user_roles.role_id from role_user as user_roles where user_roles.user_id = users.id ORDER BY user_roles.role_id DESC limit 1)'), $request->role);
            }*/
        }

        if ($request->searchText != '') {
            $users = $users->where(function ($query) {
                $query->where('users.name', 'like', '%' . request('searchText') . '%')
                    ->orWhere('users.email', 'like', '%' . request('searchText') . '%');
            });
        }

        return $users->groupBy('users.id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()

                    ->destroy(true)
                    ->dom($this->domHtml)
                    ->orderBy(2)
                    ->responsive(true)
                    ->serverSide(true)
                    ->stateSave(true)
                    ->processing(true)
                    ->language(__('app.datatable'))
                    ->parameters([
                        'initComplete' => 'function () {
                            window.LaravelDataTables["users-table"].buttons().container()
                             .appendTo( "#table-actions")
                         }',
                        'fnDrawCallback' => 'function( oSettings ) {
                           //
                           $(".select-picker").selectpicker();
                         }',
                    ])
                    ->buttons(Button::make(['extend' => 'excel', 'text' => '<i class="fa fa-file-export"></i> ' . trans('app.exportExcel')])
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'check' => [
                'title' => '<input type="checkbox" name="select_all_table" id="select-all-table" onclick="selectAllTable(this)">',
                'exportable' => false,
                'orderable' => false,
                'searchable' => false
            ],
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false, 'visible' => false],
            __('app.id') => ['data' => 'id', 'name' => 'id', 'title' => __('app.id')],
            __('app.name') => ['data' => 'name', 'name' => 'name', 'exportable' => false, 'title' => __('app.name')],
            __('app.employee') => ['data' => 'employee_name', 'name' => 'name', 'visible' => false, 'title' => __('app.employee')],
            __('app.email') => ['data' => 'email', 'name' => 'email', 'title' => __('app.email')],
            __('app.role') => ['data' => 'role', 'name' => 'role', 'width' => '20%', 'orderable' => false, 'exportable' => false, 'title' => __('app.role'), 'visible' => true],
            __('app.status') => ['data' => 'status', 'name' => 'status', 'title' => __('app.status')],
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
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
        return 'Users_' . date('YmdHis');
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
