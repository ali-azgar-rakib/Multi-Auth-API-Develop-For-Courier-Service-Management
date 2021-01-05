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
                            <li class="breadcrumb-item active">Add Zone</li>
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
                                <h3 class="card-title">Add Zone</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="addZone">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Zone Name</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter zone name"
                                            v-model="form.name"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'name'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="name"
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
                                        {{
                                            form.busy ? "adding.." : "Add Zone"
                                        }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- table columnt start here  -->

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Zones</h3>
                            </div>
                            <!-- /.card-header -->
                            <div
                                class="card-body table-responsive p-0"
                                style="height: 300px"
                            >
                                <table
                                    class="table table-head-fixed text-nowrap"
                                >
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Zone Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                item, index
                                            ) in zoneData.data"
                                            :key="index"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.name }}</td>
                                            <td>
                                                <button
                                                    @click.prevent="
                                                        deleteZone(item.id)
                                                    "
                                                    class="btn btn-sm btn-danger"
                                                    :disabled="busy"
                                                >
                                                    {{ status }}
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- pagination -->
                                <pagination
                                    align="center"
                                    :data="zoneData"
                                    @pagination-change-page="getResults"
                                >
                                    <span slot="prev-nav">&lt; Previous</span>
                                    <span slot="next-nav">Next &gt;</span>
                                </pagination>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- table columnt end here  -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            zoneData: {},
            busy: false,
            form: new Form({
                name: "",
            }),
        };
    },
    mounted() {
        // Fetch initial results
        this.getResults();
    },
    methods: {
        getResults(page = 1) {
            axios.get("/api/admin/zone?page=" + page).then((response) => {
                this.zoneData = response.data;
            });
        },
        addZone() {
            this.$Progress.start();
            this.form
                .post("/api/admin/zone")
                .then((res) => {
                    this.getResults();
                    this.form.name = "";
                    this.$Progress.finish();
                    toast.fire({
                        icon: "success",
                        title: "Created Successfully!",
                    });
                })
                .catch((res) => {
                    toast.fire({
                        icon: "error",
                        title: "Something went wrong",
                    });
                    this.$Progress.fail();
                });
        },
        deleteZone(id) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.busy = true;
                    axios
                        .delete("/api/admin/zone/" + id)
                        .then((res) => {
                            this.busy = false;
                            this.getResults();
                            swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                        })
                        .catch(() => {
                            swal.fire(
                                "Not Deleted!",
                                "Something went wrong.",
                                "error"
                            );
                        });
                }
            });
        },
    },
    computed: {
        status() {
            if (this.busy) {
                return "deleting...";
            } else {
                return "Delete";
            }
        },
    },
};
</script>

<style>
</style>