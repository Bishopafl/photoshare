<template>
    <div>
        <form @submit.prevent="createAlbum" enctype="multipart/form-data" v-if="!success">
            <div class="form-group">
                <label>Name of Album</label>
                <input type="text" name="name" class="form-control" v-model="name" maxlength="15">
                <span v-if="allErrors.name" :class="['danger']">
                    {{ allErrors.name[0] }}
                </span>
            </div>
            <div class="form-group">
                <label>Description of Album</label>
                <textarea name="description" class="form-control" v-model="description" maxlength="200"></textarea>
                <span v-if="allErrors.description" :class="['danger']">
                    {{ allErrors.description[0] }}
                </span>
            </div>
            <div class="form-group">
                <label>Category of Album</label>
                <select class="form-control" name="category" v-model="category">
                    <option v-for="(category, index) in categories" :key="index" :value="category.id">
                        {{ category.name }}
                    </option>
                    <span v-if="allErrors.category" :class="['danger']">
                        {{ allErrors.category[0] }}
                    </span>
                </select>
            </div>
            <div class="form-group">
                <label>Image of Album</label>
                <input type="file" name="image" class="form-control" v-on:change="onImageChange">
                <span v-if="allErrors.image" :class="['danger']">
                    {{ allErrors.image[0] }}
                </span>
            </div>
            <div class="form-group mt-3">
                <button class="btn btn-secondary" type="submit">Create Album</button>
            </div>
        </form>
        <div v-if="success">
            <a :href="'/upload/images/'+album.id">Your album is created. Please click the link to upload your photos!</a>
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
            allErrors:[],
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
                // console.log(response.data.id);
                this.success=true;
            }).catch((error) => {
                console.log(error)
                this.allErrors = error.response.data.errors;
            });
        },
    }
}
</script>
<style type="text/css">
    .danger {
        color: red;
    }
</style>