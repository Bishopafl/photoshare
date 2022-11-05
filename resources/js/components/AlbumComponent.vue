<template>
    <div>
        <form @submit.prevent="createAlbum" enctype="multipart/form-data" v-if="!success">
            <div class="form-group">
                <label>Name of Album</label>
                <input type="text" name="name" class="form-control" v-model="name" maxlength="15">
            </div>
            <div class="form-group">
                <label>Description of Album</label>
                <textarea name="description" class="form-control" v-model="description" maxlength="200"></textarea>
            </div>
            <div class="form-group">
                <label>Category of Album</label>
                <select class="form-control" name="category" v-model="category">
                    <option v-for="(category, index) in categories" :key="index" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Image of Album</label>
                <input type="file" name="image" class="form-control" v-on:change="onImageChange">
            </div>
            <div class="form-group mt-3">
                <button class="btn btn-secondary" type="submit">Create Album</button>
            </div>
        </form>
        <div v-if="success">
            <a :href="'gallery/'+albumId">Your album is created. Please click the link to upload your photos!</a>
        </div>
    </div>
</template>
<script type="text/javascript">
import axios from 'axios';

export default {
    data() {
        return {
            name:'',
            description:'',
            category:'',
            image:'',
            categories:[],
            albumId:'',
            success:false,
        }
    },
    created() {
        this.getCategories()
    },
    methods:{
        getCategories() {
            axios.get('/api/categories').then((response) => {
                this.categories = response.data
            }).catch((error) => {
                alert('Unable to fetch categories')
            })
        },
        onImageChange(e) {
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        createAlbum() {
            
            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('category_id', this.category);
            axios.post('/albums/store', formData, {
                headers:{
                    "Content-Type":"multipart/form-data",
                }
            }).then((response) => {
                this.image = '',
                this.name = '',
                this.description = '',
                this.category = '',
                this.albumId = response.data.id,
                console.log(response.data.id);
                this.success=true;
            }).catch((error) => {
                console.log(error)
            });
        },
    }
}
</script>