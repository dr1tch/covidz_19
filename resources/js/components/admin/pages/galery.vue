<template>
<div>
    <!-- Add Image Modal -->
    <modal name="add-album-modal" height="auto" width="500px" classes="text-light bg-secondary p-0">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">Create Album</h4>
            </div>
            <form action="/upload" method="post" enctype="multipart/form-data" @submit.prevent="createAlbum">
                <div class="card-body">
                    <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Album Name.." v-model="name">
                    <textarea type="text" class="form-control bg-secondary text-light" placeholder="Album description.." v-model="description"></textarea>
                    <div class="flex justify-content-between align-items-center p-2">
                    <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Select a Cover Image">
                        <label for="path" class="flex" style="margin-bottom: 0;">
                            <div>
                                <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </div>
                        </label>
                    </button>
                    <input type="file" name="path" id="path" @change="newCover" style="display: none;">
                    <img :src="imgPreview" alt="" class="img-preview img-fluid rounded-lg">
                    </div>
                </div>
                <div class="card-footer flex justify-content-between align-items-center">
                    <button type="button" @click="$modal.hide('add-album-modal')" class="btn btn-sm btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success">Add</button>
                </div>
            </form>
        </div>
    </modal>

    <!-- Show Image Modal -->
    <modal name="show-image-modal" height="auto" width="100%" classes="p-0 bg-transparent shadow-none">
        <div class="flex justify-content-center align-items-center">
            <img :src="img" alt="" class="img-fluid rounded-lg">
        </div>
    </modal>

    <!--  Edit Album Modal -->

    <modal name="edit-album-modal" height="auto" width="500px" classes="text-light bg-secondary p-0">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">Edit Album</h4>
            </div>
            <form :action="`/editTag/${edited.id}`" method="post" enctype="multipart/form-data" @submit.prevent="editAlbum">
                <div class="card-body">
                    <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Album Name.." v-model="name">
                    <textarea type="text" class="form-control bg-secondary text-light" placeholder="Album description.." v-model="description"></textarea>
                    <div class="flex justify-content-between align-items-center p-2">
                    <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Select a Cover Image">
                        <label for="path" class="flex" style="margin-bottom: 0;">
                            <div>
                                <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </div>
                        </label>
                    </button>
                    <input type="file" name="path" id="path" @change="newCover" style="display: none;">
                    <img :src="imgSrc(cover)" alt="" class="img-preview img-fluid rounded-lg" v-if="! imgPreview">
                    <img :src="imgPreview" alt="" class="img-preview img-fluid rounded-lg" v-if="imgPreview">
                    </div>
                </div>
                <div class="card-footer flex justify-content-between align-items-center">
                    <button type="button" @click="$modal.hide('edit-album-modal')" class="btn btn-sm btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success">Add</button>
                </div>
            </form>
        </div>
    </modal>

    <div class="card bg-card">
        <div class="card-header flex justify-content-between align-items-center">
            <h1 v-text="routeName"></h1>
            <button type="button" class="btn btn-sm btn-outline-primary" @click="$modal.show('add-album-modal')">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-images" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.002 4h-10a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1zm-10-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-10zm4 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    <path fill-rule="evenodd" d="M4 2h10a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1v1a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2h1a1 1 0 0 1 1-1z" />
                </svg>
                Create Album
            </button>
        </div>
        <div class='table-responsive card-body' v-if="albums.length">
            <table id="my-table" class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th>Album Name</th>
                        <th>Album Description</th>
                        <th>Album Cover</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(album) in showAlbums" :key="album.id">
                        <td v-text="album.id"></td>
                        <td><a href="" v-text="album.name" class="text-light"></a></td>
                        <td v-text="album.description"></td>
                        <td>
                            <button data-toggle="tooltip" data-placement="bottom" title="See Cover Image" type="button" @click="showModalImage('show-image-modal', imgSrc(album.cover_image))" class="btn">
                                 <img :src="imgSrc(album.cover_image)" alt="" class="img-fluid avatar">
                            </button>
                        </td>
                        <td>{{ moment(album.created_at).format("DD-MM-YYYY") }}</td>
                        <td>
                            <div>
                                <button type="button" @click.prevent="showModal('edit-album-modal',album)" class="btn btn-sm btn-primary">Edit</button>
                                <button type="button" @click.prevent="showModal('delete-album-modal',album)" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
        <h2 v-else class="alert text-center p-5 text-warning">NO ALBUMS ADDED YET!!!!</h2>
        <div class="card-footer" v-if="albums.length">
            <div class=" flex justify-content-between align-items-center">
                <div class="my-4">
                    <ul class="pagination pagination-md justify-content-center text-center">
                        <li class="page-item" :class="page === 1 ? 'disabled' : ''">
                            <a class="page-link" @click="prevPage">
                                Previous
                            </a>
                        </li>
                        <li class="page-link" style="background-color: inherit">
                            {{ page }} of {{ lastPage }}
                        </li>
                        <li class="page-item" :class="page === lastPage ? 'disabled' : ''">
                            <a class="page-link" @click="nextPage">
                                Next
                            </a>
                        </li>
                    </ul>
                </div>
                <button type="button" @click.prevent="$modal.show('delete-albums-modal')" class="btn btn-sm btn-danger">Delete All</button>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>
    img.img-preview {
        width: 100px;
        height: auto;
    }
</style>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            name: '',
            description: '',
            cover: '',
            edited: {
                id: '',
                name: '',
                description:'',
                cover_image: '',
            },
            albums: [],
            perPage: 4,
            currentPage: 1,
            page: 1,
            img: '',
            imgPreview: '',
            data : new FormData(),
        }
    },
    mounted() {
        console.log(this.$route.name);
        this.callAPI('get', '/getAlbums')
            .then(responce => this.albums = responce);
    },
    computed: {
        routeName() {
            return this.$route.name;
        },
        
        showAlbums () {
            let start = (this.page - 1) * this.perPage
            let end = start + this.perPage
            this.loading = false
            return this.albums.slice(start, end)
        },
        lastPage () {
            let length = this.albums.length 
            return Math.floor(length / this.perPage) + 1;
        },
        
    },
    methods: {
        imgSrc(cover) {
            return `images/albums/${cover}`;
        },
        newCover(event) {
            let files = event.target.files;
            if (files.length) this.cover = files[0];
            this.imgPreview = URL.createObjectURL(event.target.files[0]);
        },
        showModal(name, album) {
            this.name = album.name;
            this.description = album.description;
            this.cover = album.cover_image;
            let obj = {
                id : album.id, 
                name : album.name,
                description: album.description,
                cover_image: album.cover_image,
            }
            console.log("obj: " + obj);
            this.edited = obj;

            // this.editable = obj;
            this.$modal.show(name);
            console.log("blabla!" + this.album);
        },
        showModalImage(name, url){
            console.log(url);
            this.img = url;
            this.$modal.show(name);
        },
        prevPage () {
            this.loading = true
            this.page--
        },
        nextPage () {
            this.loading = true
            this.page++
        },
        // previewImg(event){
        //     console.log(URL.createObjectURL(event.target.files[0]));
        //     this.imgPreview = URL.createObjectURL(event.target.files[0]);
        // },
        

        // Album API:
        createAlbum() {
            this.data.set('name', this.name);
            this.data.set('description', this.description);
            this.data.set('cover', this.cover);
            this.data.set('_method', "patch");
            axios.post('/createAlbum', this.data)
                .then(response => {
                    this.$modal.hide('add-album-modal')
                }).then(() => this.callAPI('get', '/getAlbums')
                    .then(responce => this.albums = responce))
                .catch(error => console.log(error));
        },
        editAlbum(){
            this.data.set('name', this.name);
            this.data.set('description', this.description);
            this.data.set('cover', this.cover);
            this.data.set('_method', "patch");
            axios.post(`/editAlbum/${this.edited.id}`, this.data)
                .then(response => {
                    this.$modal.hide('edit-album-modal')
                }).then(() => this.callAPI('get', '/getAlbums')
                    .then(responce => this.albums = responce))
                .catch(error => console.log(error));
        }
        // deleteAlbum() {
        //     axios.post(`/deleteTag/${this.album.id}`)
        // }
    }
}
</script>
