<template>
    <div>
        <!-- Modal -->
        <div class="modal fade editComponentModal" id="editComponentModal" tabindex="-1" aria-labelledby="editComponentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editComponentModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                        <form enctype="multipart/form-data" @submit.prevent="updateAlbum">
                            <div class="form-group">
                                <label for="name">Name of Album</label>
                                <input type="text" name="name" class="form-control" maxlength="15" required v-model="editrecord.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description of Album</label>
                                <textarea class="form-control" maxlength="200" name="description" v-model="editrecord.description" />
                            </div>
                            <div class="form-group">
                                <label for="category">Category of Album</label>
                                <select name="category" v-model="editrecord.category_id" class="form-control">
                                    <option 
                                        v-for="(category, index) in categories" 
                                        :key="index" 
                                        :value="category.id"
                                    >{{ category.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image of Album</label>
                                <input type="file" name="image" class="form-control" v-on:change="onImageChange">
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-secondary" type="submit">Update Album</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
import $ from 'jquery';
import axios from 'axios';


    export default {
        props:['editrecord'],
        data() {
            return {
                categories: [],
                image: '',
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            onImageChange(e) {
                this.image = e.target.files[0];
            },
            getCategories() {
                axios.get('/api/categories').then((response) => {
                    this.categories = response.data
                }).catch((error) => {
                    alert('unable to fetch categories')
                });
            },
            updateAlbum() {
                let formData = new FormData();
                formData.append('image', this.image);
                formData.append('name', this.editrecord.name);
                formData.append('description', this.editrecord.description);
                formData.append('category_id', this.editrecord.category_id);
                formData.append("_method", "put");
                axios.post('/albums/'+this.editrecord.id+'/edit', formData, {
                    headers: {
                        "Content-Type" : "multipart/form-data"
                    }
                }).then((response) => {
                    /* somethings not right here... */
                    $('#editComponentModal').modal('hide');
                    this.$emit('recordUpdated', response);
                }).catch((error) => {
                    console.log(error);
                });
            },
        }
    }
</script>