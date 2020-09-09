<template>
<div>
     <div class="card">
        <div class="card-header flex justify-content-between align-items-center">
            <h1 v-text="routeName"></h1>
            <button
                @click="$modal.show('add-tag-modal')" 
                class=" btn btn-sm btn-outline-primary">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Add Tag
            </button>
        </div>
        <div class='table-responsive card-body' v-if="tags.length">
            <table id="my-table" class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th>Tag Name</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(tag) in showRepos" :key="tag.id" >
                        <td v-text="tag.id"></td>
                        <td v-text="tag.name"></td>
                        <td>{{ moment(tag.created_at).format("DD-MM-YYYY") }}</td>
                        <td>
                            <div>
                                <button type="button"  @click.prevent="showModal('edit-tag-modal',tag)"  class="btn btn-sm btn-primary">Edit</button>
                                <button type="button" @click.prevent="showModal('delete-tag-modal',tag)" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                        
                       
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <h2 v-else class="alert text-center p-5 text-warning">NO TAGS ADDED YET!!!!</h2>
        <div class="card-footer" v-if="tags.length">
            <div class=" flex justify-content-between align-items-center">
                <div class="my-4">
                    <ul class="pagination pagination-md justify-content-center text-center">
                        <li  class="page-item"
                            :class="page === 1 ? 'disabled' : ''"
                        >
                            <a 
                                class="page-link" 
                                @click="prevPage" 
                            >
                                Previous
                            </a>
                        </li>
                        <li class="page-link" style="background-color: inherit"> 
                            {{ page }} of {{ lastPage }}
                        </li>
                        <li  class="page-item" 
                            :class="page === lastPage ? 'disabled' : ''"
                        >
                            <a class="page-link" 
                                @click="nextPage"
                            >
                                Next
                            </a>
                        </li>
                    </ul>
                </div>
                    <button type="button" @click.prevent="$modal.show('delete-tags-modal')" class="btn btn-sm btn-danger">Delete All</button>
                </div>
            </div>
        </div>
        <!-- Add Tag Modal -->
        <modal
            name="add-tag-modal"
            height="auto"
            width="500px"
            classes="text-light bg-secondary"
        >
            <div>
            
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Add Tag</h4>
                    </div>
                    <form action="/addTag" method="POST" @submit.prevent="addTag" @keydown="form.errors.clear($event.target.name)">
                        <div class="card-body">
                            <div>
                                <input type="text" class=" form-control bg-secondary text-light" placeholder="Tag Name.." v-model="form.tagName">
                                <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('add-tag-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success" :disabled="form.errors.any()">Add</button>
                            </div>
                        </div>
                     </form>
                </div>
           
            </div>
        </modal>
        <!-- Edit Tag Modal -->
        <modal
                name="edit-tag-modal"
                height="auto"
                width="500px"
                classes="text-light bg-secondary"
            >
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Edit Tag</h4>
                    </div>
                    <form :action="`/editTag/${editable.id}`" method="POST" @submit.prevent="editTag" @keydown="form.errors.clear($event.target.name)">
                        <div class="card-body">
                            <div>
                                <input type="text" class=" form-control bg-secondary text-light" v-model="form.tagName" :placeholder="editable.tagName">
                                <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('edit-tag-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success" :disabled="form.errors.any()">Edit</button>
                            </div>
                        </div>
                     </form>
                    
                </div>
        </modal>
        <!-- Delete Tag Modal -->
         <modal
                name="delete-tag-modal"
                height="auto"
                width="500px"
                classes="text-light bg-secondary"
            >
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Delete Tag</h4>
                    </div>
                    <form :action="`/deleteTag/${editable.id}`" method="POST" @submit.prevent="deleteTag" @keydown="form.errors.clear($event.target.name)">
                        <div class="card-body">
                            <div>
                                <h5 class="alert font-size-lg m-auto text-center">Are You Sure!!</h5>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('delete-tag-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Delete</button>
                            </div>
                        </div>
                     </form>
                    
                </div>
        </modal>

         <!-- Delete All Tag Modal -->
         <modal
                name="delete-tags-modal"
                height="auto"
                width="500px"
                classes="text-light bg-secondary"
            >
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Delete Tag</h4>
                    </div>
                    <form action="/deleteAllTags" method="POST" @submit.prevent="deleteAllTags">
                        <div class="card-body">
                            <div>
                                <h5 class="alert font-size-lg m-auto text-center">Are You Sure!!</h5>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('delete-tags-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Delete</button>
                            </div>
                        </div>
                     </form>
                    
                </div>
        </modal>
        
    </div>

</template>

<style scoped>
    .main-wall {
        border: none;
        max-width: 100%;
        margin-right:auto;
    }
    .vm--overlay {
        background: unset;
    }
    .vm--modal {
        box-shadow: unset;
    }
    ul {
        margin-bottom: 0;
    }
</style>

<script>
    
    import Form from '../../../Form'
    import moment from 'moment'
    // import editModal from "../templates/editModal"
    export default {
        // components: { editModal },
        data() {
            return {
                form: new Form({
                    tagName: '',
                }),
                tags: [],
                perPage: 4,
                currentPage: 1,
                editable: {
                    id: '',
                    tagName: '',
                },
                page: 1,
                loading: false,
            }
        },
        mounted (){
            console.log(this.$route.name);
            this.callAPI('get', '/getTags')
                            .then(responce => this.tags = responce);
            console.log(this.tags);
        },
        computed: {
            routeName (){
                return this.$route.name;
            },
            errors (){
                return Object.keys(this.form.errors.errors).length > 0;
            },
            date(d){
                return new Date(d);
            },
            rows() {
                return this.tags.length
            },
            showRepos () {
                let start = (this.page - 1) * this.perPage
                let end = start + this.perPage
                this.loading = false
                return this.tags.slice(start, end)
            },
            lastPage () {
                let length = this.tags.length 
                return Math.floor(length / this.perPage) + 1;
            },
            date(d){
                return moment(d).format("dddd, MMMM Do YYYY");
            }     
        },
        // async created() {
        //     const res = await this.callAPI('post', '/addTag', {tagName: 'test'});
        //     console.log(res);
        //     if(status == 200){
        //         console.log(res);
        //     }
        // },
        methods: {
            showModal(name, tag){
                let obj = {
                    id : tag.id, 
                    tagName : tag.name
                }
                console.log("obj: " + obj);
			    this.editable = obj;
                this.$modal.show(name);
                console.log("blabla!" + this.editable.tagName);
            },
            prevPage () {
                this.loading = true
                this.page--
            },
            nextPage () {
                this.loading = true
                this.page++
            },
            
            // API PART:
            addTag() {
            this.form.post('/addTag')
                .then(() => this.$modal.hide('add-tag-modal'))
                .then(() => this.callAPI('get', '/getTags')
                            .then(responce => this.tags = responce));
            },
             editTag() {
                this.form.post(`/editTag/${this.editable.id}`)
                    .then(() => this.$modal.hide('edit-tag-modal'))
                    .then(() => this.callAPI('get', '/getTags')
                                .then(responce => this.tags = responce));
             },
             deleteTag() {
                 this.form.post(`/deleteTag/${this.editable.id}`)
                    .then(() => this.$modal.hide('delete-tag-modal'))
                    .then(() => this.callAPI('get', '/getTags')
                                .then(responce => this.tags = responce));
             },
             deleteAllTags() {
                 this.form.post('/deleteAllTags')
                    .then(() => this.$modal.hide('delete-tags-modal'))
                    .then(() => this.callAPI('get', '/getTags')
                                .then(responce => this.tags = responce));
             }
            
        },
    }
</script>
