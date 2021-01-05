<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Slider</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Add Slider</li>
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
                                <h3 class="card-title">Add Slider</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form
                                role="form"
                                @submit.prevent="addSlider"
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
                                            >Sub title</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter size sub-title name"
                                            v-model="form.sub_title"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'sub_title'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="sub_title"
                                        ></has-error>
                                    </div>
                                    <!-- Slider photo  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Slider Photo</label
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
                                            form.busy
                                                ? "adding.."
                                                : "Add Slider"
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
    mounted() {},
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
        addSlider() {
            this.$Progress.start();
            this.form
                .post("/api/admin/slider")
                .then((res) => {
                    this.$Progress.finish();
                    this.$router.push("/admin/all/slider");
                })
                .catch((res) => {
                    this.$Progress.fail();
                });
        },
    },
};
</script>

<style>
</style>