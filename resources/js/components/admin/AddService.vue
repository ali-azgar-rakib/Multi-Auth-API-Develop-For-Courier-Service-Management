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
                            <li class="breadcrumb-item active">Add Service</li>
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
                    <div class="col-md-6 m-auto">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Service</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form
                                role="form"
                                @submit.prevent="addService"
                                enctype="multipart/form-data"
                            >
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Title</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter title name"
                                            v-model="form.title"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'title'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="title"
                                        ></has-error>
                                    </div>

                                    <!-- sub title  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Service Details</label
                                        >
                                        <textarea
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter size sub-title name"
                                            v-model="form.body"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'body'
                                                ),
                                            }"
                                        ></textarea>
                                        <has-error
                                            :form="form"
                                            field="body"
                                        ></has-error>
                                    </div>
                                    <!-- Slider photo  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Service Photo</label
                                        >
                                        <input
                                            type="file"
                                            class="form-control"
                                            name="photo"
                                            @change="selectPhoto"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'photo'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="photo"
                                        ></has-error>
                                        <img
                                            v-if="form.photo"
                                            :src="form.photo"
                                            alt
                                            height="100"
                                        />
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
                                            form.busy ? "Adding" : "Add Service"
                                        }}
                                    </button>
                                </div>
                            </form>
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
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                title: "",
                sub_title: "",
                photo: "",
            }),
        };
    },
    methods: {
        selectPhoto(e) {
            let file = event.target.files[0];
            if (file == "") {
                alert("choose a photo");
            } else {
                let reader = new FileReader();
                reader.onload = (event) =>
                    (this.form.photo = event.target.result);
                reader.readAsDataURL(file);
            }
        },
        addService() {
            this.$Progress.start();
            this.form
                .post("/api/admin/service")
                .then((res) => {
                    this.$Progress.finish();
                    toast.fire({
                        icon: "success",
                        title: "Service added successfully",
                    });
                    this.$router.push("/admin/all/service");
                })
                .catch((res) => {
                    toast.fire({
                        icon: "error",
                        title: "Something went wrong!",
                    });
                    this.$Progress.fail();
                });
        },
    },
};
</script>

<style>
</style>