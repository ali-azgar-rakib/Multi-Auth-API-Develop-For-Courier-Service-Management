<template>
    <span>
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
                                    Add Slider
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
            <section class="content col-10 mx-auto">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- left column -->
                        <div
                            v-for="(slider, index) in sliderData.data"
                            :key="index"
                            class="card mb-3 mx-auto"
                        >
                            <img
                                :src="`/uploads/${slider.photo}`"
                                class="card-img-top"
                                alt="Slider Photo"
                                height="400"
                            />
                            <div class="card-body">
                                <h5 class="card-title">{{ slider.title }}</h5>
                                <p class="card-text">{{ slider.sub_title }}</p>
                                <p class="card-text">
                                    <small class="text-muted"
                                        >Last updated 3 mins ago</small
                                    >
                                </p>
                            </div>
                            <div class="card-footer">
                                <button
                                    class="btn btn-primary"
                                    @click.prevent="deleteSlider(slider.id)"
                                    :disabled="busy"
                                >
                                    {{ status }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- pagination -->
                    <pagination
                        align="center"
                        :data="sliderData"
                        @pagination-change-page="getResults"
                    >
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </span>
</template>

<script>
export default {
    data() {
        return {
            sliderData: {},
            busy: false,
        };
    },
    mounted() {
        // Fetch initial results
        this.getResults();
    },
    methods: {
        // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get("/api/admin/slider?page=" + page).then((response) => {
                this.sliderData = response.data;
            });
        },
        deleteSlider(id) {
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
                        .delete("/api/admin/slider/" + id)
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