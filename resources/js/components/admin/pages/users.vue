<template>  
        <div class="card">
        <div class="card-header">
            <h1 v-text="routeName"></h1>
        </div>
        <div class='table-responsive card-body'>
            <table class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th  class="hidden-sm">Full Name</th>
                        <th>Username</th>
                        <th class="hidden-md">E-Mail</th>
                        <th>Status</th>
                        <th>Profile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</th>
                        <td  class="hidden-sm">Kacemi Youssouf</td>
                        <td>@octothorpe21</td>
                        <td class="hidden-md">ycef5411@gmail.com</td>
                        <td>Verified</td>
                        <td>
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" src="/images/profile.jpg" alt="">
                            </a>
                        </td>
                        <td>
                            <div>
                                <button type="button" class="btn btn-sm btn-primary">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center bg-transparent">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped>
    .main-wall {
        border: none;
        max-width: 100%;
        margin-right:auto;
    }
</style>


<script>
    import tab from '../templates/tab'
    export default {
        components: { tab, },
        mounted (){
        console.log(this.$route.name);
        },
        computed: {
            routeName (){
                return this.$route.name;
            }
        },
    }
</script>