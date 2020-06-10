@extends('layouts.app')

@section('content')
<div class="content bg-light" id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card" style="background: #FFF; box-shadow: -1px -11px 8px 3px rgb(243, 243, 243);">
            <div class="card-header">
              <h5 class="title text-dark">Create Employee</h5>
            </div>
              <form @submit.prevent="handleSubmit">
                <div class="card-body">
                    <div class="row">
                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-md-1">
                        <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input id="full-name" v-model="employee.name" type="text" class="form-control" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                        <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" disabled v-model="employee.email" id="email" class="form-control" placeholder="name@email.com">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-md-1">
                        <div class="form-group">
                        <label for="position-held">Position held</label>
                        <input id="position-held" v-model="employee.position_held" type="text" class="form-control" placeholder="Position Held">
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                        <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" v-model="employee.salary" id="salary" class="form-control" placeholder="32,000">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-md-1">
                        <div class="form-group">
                            <label for="work-type">Work Type</label>
                            <input id="work-type" v-model="employee.work_type" type="text" class="form-control" placeholder="Full Time">
                        </div>
                        </div>
                    <div class="col-md-4 pr-md-1">
                        <div class="form-group">
                        <label for="status">Status</label>
                        <input id="status" type="text" v-model="employee.status" class="form-control" placeholder="Status">
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                        <div class="form-group">
                        <label for="status-time">Status Time</label>
                        <input type="text" id="status-time" v-model="employee.status_time" class="form-control" placeholder="Status Time">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="employee.address" placeholder="Address">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 pr-md-1">
                        <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" v-model="employee.city" placeholder="City">
                        </div>
                    </div>
                    <div class="col-md-4 px-md-1">
                        <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" v-model="employee.country" placeholder="Country">
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                        <div class="form-group">
                        <label>Postal Code</label>
                        <input type="number" class="form-control" v-model="employee.postal_code" placeholder="ZIP Code">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
                <div class="card-footer">
                <button type="submit" :disabled="isLoading" class="btn btn-fill btn-success">
                    <span v-if="!isLoading">Update</span>
                    <img v-else style="height: 14px" src="{{ asset('./img/loader_rolling.gif') }}" alt="Loading">
                </button>
                </div>
              </form>
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
                employee: {},
                isLoading: false,
            },
            methods: {
                showNotification(message, type = 'danger') {  
                    $.notify({
                        icon: "tim-icons icon-bell-55",
                        message,
                    }, {
                        type: type,
                        timer: 8000,
                        placement: {
                            from: 'top',
                            align: 'left'
                        }
                    });
                },
                async handleSubmit() {
                    const { id, name, email, position_held, salary, work_type, status, status_time, address, city, country, postal_code } = this.employee;
                    if (name && position_held && salary && work_type && status && status_time && address && city && country && postal_code) {
                        const data = { name, position_held, salary, work_type, status, status_time, address, city, country, postal_code };
                        this.isLoading = true;
                        try {
                            const response = await axios.put(`/api/employees/${id}`, data);
                            this.isLoading = false;
                            this.showNotification(response.data.message, 'success');
                        } catch (error) {
                            this.isLoading = false;
                            if (error.response.status == 401 || error.response.status == 404) {
                                let { message } = error.response.data;
                                let keys = Object.keys(error.response.data.message);
                                
                                keys.forEach((errMsg) => {
                                    this.showNotification(message[errMsg]);
                                })
                            }
                        }
                    } else {
                        this.showNotification("Please fill in all fields.");
                    }
                },
                async fetchEmployeeDetails() {
                    const employeeId = window.location.pathname.split('/')[window.location.pathname.split('/').length - 1];
                    this.isLoading = true;
                    try {
                        this.isLoading = false;
                        const response = await axios.get(`/api/employees/${employeeId}`);
                        this.employee = response.data.data;
                    } catch(error) {
                        this.isLoading = false;
                        if (error.response.status) {
                            this.showNotification('An Error occured, try refreshing');
                        }
                    }
                }
            },
            created() {
                this.fetchEmployeeDetails();
            }
        })
    </script>
@endsection