<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admin Dashboard</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Add Open Time
                            </li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-4 mx-auto">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Set Open Time</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="timeSet">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Start Time(
                                            <small>24 hour format</small>)
                                        </label>
                                        <br />
                                        <vue-timepicker
                                            v-model="form.start_time"
                                            close-on-complete
                                            format="HH:mm:ss"
                                            :input-class="[
                                                'form-control',
                                                {
                                                    'is-invalid': form.errors.has(
                                                        'start_time'
                                                    ),
                                                },
                                            ]"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'start_time'
                                                ),
                                            }"
                                        ></vue-timepicker>
                                        <has-error
                                            :form="form"
                                            field="start_time"
                                        ></has-error>
                                    </div>

                                    <!-- dest2                      -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            End Time(
                                            <small>24 hour format</small>)
                                        </label>
                                        <br />
                                        <vue-timepicker
                                            v-model="form.end_time"
                                            close-on-complete
                                            format="HH:mm:ss"
                                            :input-class="[
                                                'form-control',
                                                {
                                                    'is-invalid': form.errors.has(
                                                        'start_time'
                                                    ),
                                                },
                                            ]"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'start_time'
                                                ),
                                            }"
                                        ></vue-timepicker>

                                        <has-error
                                            :form="form"
                                            field="end_time"
                                        ></has-error>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block"
                                        :disabled="form.busy"
                                    >
                                        {{ status }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- table start  -->
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Open Time</h3>
                            </div>
                            <!-- /.card-header -->
                            <div
                                class="card-body table-responsive p-0"
                                style="height: 260px"
                            >
                                <table
                                    class="table table-head-fixed text-nowrap"
                                >
                                    <thead>
                                        <tr>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ time.start_time }}</td>
                                            <td>{{ time.end_time }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- content wrapper  -->
</template>

<script>
import VueTimepicker from "vue2-timepicker/src/vue-timepicker";
export default {
    components: {
        VueTimepicker,
    },
    mounted() {
        this.getTime();
    },
    data() {
        return {
            time: "",
            form: new Form({
                start_time: "",
                end_time: "",
            }),
            busy: false,
        };
    },
    methods: {
        timeSet() {
            this.busy = true;
            this.$Progress.start();
            this.form
                .post("/api/admin/open-time")
                .then((res) => {
                    this.getTime();
                    this.busy = false;
                    this.$Progress.finish();
                    toast.fire({
                        icon: "success",
                        title: "Time Set Successfully",
                    });
                })
                .catch((res) => {
                    this.busy = false;
                    this.$Progress.fail();
                    toast.fire({
                        icon: "error",
                        title: "Something went wrong",
                    });
                });
        },
        getTime() {
            axios
                .get("/api/admin/open-time")
                .then((res) => (this.time = res.data));
        },
    },
    computed: {
        status() {
            if (this.busy) {
                return "setting...";
            } else {
                return "Set";
            }
        },
    },
};
</script>

<style>
</style>