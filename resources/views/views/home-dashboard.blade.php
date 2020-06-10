@extends('layouts.app')

@section('content')
<div class="content bg-light" id="app">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="text-dark">
                        employee
                    </h3>
                </div>
                <div>
                    <a href="{{ url('/create-employee') }}" class="btn btn-success rounded-pill">
                        add employee
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card" style="background: transparent; box-shadow: none;">
            <div class="card-body">
                <div class="table-full-width table-responsive" style="overflow: auto;">
                <table class="table" id="employees-table">
                    <thead>
                        <tr>
                            <td>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                                </label>
                            </div>
                            </td>
                            <td>
                                <p class="title text-dark">Employee</p>
                            </td>
                            <td>
                                <p class="title text-dark">Salary</p>
                            </td>
                            <td>
                                <p class="title text-dark">Status</p>
                            </td>
                            <td>
                                <p class="title text-dark">Manage</p>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(employee, index) in employees" :key="index">
                            <tr class="bg-white">
                                <td class="tr-border-left">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="photo" style="margin: 0; margin-right: 10px;">
                                            <img src="{{ asset('./img/anime3.png') }}" alt="Profile Photo">
                                        </div>
                                        <div>
                                            <p class="title text-dark">@{{ employee.name }}</p>
                                            <p class="text-muted">@{{ employee.position_held }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="title text-dark">$ @{{ employee.salary }}</p>
                                        <p class="text-muted">@{{ employee.work_type }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="title text-dark">@{{ employee.status }}</p>
                                        <p class="text-muted">@{{ employee.status_time }}</p>
                                    </div>
                                </td>
                                <td class="td-actions text-center tr-border-right">
                                    <div class="d-flex">
                                        <a :href="'edit-employee/' + employee.id" class="border-right flex-grow-1">
                                            <i class="tim-icons icon-pencil table-action-icon"></i>
                                        </a>
                                        <a @click="handleDeleteEmployee(employee.id)" class="flex-grow-1">
                                            <i class="tim-icons icon-trash-simple table-action-icon"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr role="row" class="even" style="visibility: hidden;">                                      
                                <td class="td-actions">
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
    <script>
        new Vue({
            el: '#app',
            data: {
                employees: [],
            },
            methods: {
                showNotification(message, type = 'danger') {  
                    $.notify({
                        icon: "tim-icons icon-bell-55",
                        message,
                    }, {
                        type,
                        timer: 8000,
                        placement: {
                            from: 'top',
                            align: 'left'
                        }
                    });
                },
                async fetchEmployees() {
                    try {
                        const response = await axios.get('/api/employees');
                        this.employees = response.data.data;
                        // document.querySelector('.dataTables_empty').style.display = 'none';
                    } catch(error) {
                        if (error.response.status) {
                            this.showNotification('An Error occured, try refreshing');
                        }
                    }
                },
                async handleDeleteEmployee(id) {
                    try {
                        const response = await axios.delete(`/api/employees/${id}`);
                        this.showNotification(response.data.message, 'success');
                        this.fetchEmployees();
                    } catch(error) {
                        if (error) {
                            this.showNotification('An Error occured, try refreshing');
                        }
                    }
                }
            },
            created() {
                this.fetchEmployees();
            }
        })
    </script>
@endsection