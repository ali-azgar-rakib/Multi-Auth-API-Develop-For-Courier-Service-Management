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
                                <h3 class="card-title">Contact Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="contactDetails">
                                <div class="card-body">
                                    <!-- email  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Email</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Your Email.."
                                            v-model="form.email"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'email'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="email"
                                        ></has-error>
                                    </div>

                                    <!-- primary phone  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Phone Number(primary)</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Phone Number"
                                            v-model="form.primary_phone"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'primary_phone'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="primary_phone"
                                        ></has-error>
                                    </div>

                                    <!-- optional phone  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Phone Number(optional)</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter title name"
                                            v-model="form.optional_phone"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'optional_phone'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="optional_phone"
                                        ></has-error>
                                    </div>

                                    <!-- optional phone  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Open Day</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter 'monday-saturday' like this"
                                            v-model="form.open_day"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'open_day'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="open_day"
                                        ></has-error>
                                    </div>

                                    <!-- open time  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Open Hour</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter '6am - 5pm' like this"
                                            v-model="form.open_time"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'open_time'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="open_time"
                                        ></has-error>
                                    </div>

                                    <!-- fb link  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Facebook</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter FB Link"
                                            v-model="form.fb"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'fb'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="fb"
                                        ></has-error>
                                    </div>

                                    <!-- twitter link  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Twitter</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Twitter Link"
                                            v-model="form.twitter"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'twitter'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="twitter"
                                        ></has-error>
                                    </div>

                                    <!-- youtube link  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Youtube</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Youtube Link"
                                            v-model="form.youtube"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'youtube'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="youtube"
                                        ></has-error>
                                    </div>

                                    <!-- instagram link  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Instagram</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Instagram Link"
                                            v-model="form.insta"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'insta'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="insta"
                                        ></has-error>
                                    </div>

                                    <!-- linkedin link  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >LinkedIn</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            placeholder="Enter Instagram Link"
                                            v-model="form.linked_in"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'linked_in'
                                                ),
                                            }"
                                        />
                                        <has-error
                                            :form="form"
                                            field="linked_in"
                                        ></has-error>
                                    </div>

                                    <!-- address  -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Address</label
                                        >
                                        <textarea
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter Address"
                                            v-model="form.address"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'address'
                                                ),
                                            }"
                                        ></textarea>
                                        <has-error
                                            :form="form"
                                            field="address"
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
                                            form.busy ? "updating..." : "Update"
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
    <!-- content wrapper  -->
</template>

<script>
export default {
    mounted() {
        this.getContactDetails();
    },
    data() {
        return {
            form: new Form({
                email: "",
                primary_phone: "",
                optional_phone: "",
                open_day: "",
                open_time: "",
                address: "",
                fb: "",
                twitter: "",
                linked_in: "",
                youtube: "",
                insta: "",
            }),
        };
    },
    methods: {
        getContactDetails() {
            axios
                .get("/api/admin/contact-details")
                .then((res) => this.form.fill(res.data[0]));
        },
        contactDetails() {
            this.$Progress.start();
            this.form
                .post("/api/admin/contact-details")
                .then((res) => {
                    this.$Progress.finish();
                    toast.fire({
                        icon: "success",
                        title: "Contact Updated Successfully",
                    });
                })
                .catch((res) => {
                    this.$Progress.fail();
                    toast.fire({
                        icon: "error",
                        title: "Something went wrong",
                    });
                });
        },
    },
};
</script>

<style>
</style>