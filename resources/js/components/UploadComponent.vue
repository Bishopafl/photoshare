<template>
    <div>
        <form enctype="multipart/form-data" method="post">
            <div class="form-group text-center" ref="fileform">
                <input type="file" name="" ref="file" multiple="multiple" id="uploadImage">
                <span id="val"></span>
                <a class="btn btn-secondary" @click.prevent="submitFiles()">Upload</a>
            </div>
        </form>
        <progress max="100" style="width:100%" :value.prop="uploadPercentage" v-if="uploading"></progress>
        <div class="container">
            <hr class="mt-2 mb-5">
            <div class="row text-center text-lg-left">
                <div class="col-lg-3 col-md-4 col-6" v-for="(image, index) in images" :key="index">
                    <a href="#">
                        <img :src="'/images/'+image.image" class="img-fluid img-thumbnail">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
import axios from 'axios';

export default {
    props:['album_id'],
    data() {
        return {
            uploadPercentage: '',
            uploading: false,
            images: [],
        }
    },
    mounted() {
        this.getImage()
    },  
    methods: {
        submitFiles() {
            let formData = new FormData();
            for (let i = 0; i < this.$refs.file.files.length; i++) {
                let file = this.$refs.file.files[i];
                formData.append('files['+i+']', file); // append file into files
                formData.append('album_id', this.album_id);
            }
            this.uploading = true;
            this.$refs.file.value = '';
            axios.post('/uploadImage', formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                },
                onUploadProgress: function(progressEvent) {
                    this.uploadPercentage = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total));
                }.bind(this)
            }).then((response) => {
                this.getImage();
            }).catch((error) => {
                console.log(error);
            })
        },
        getImage() {
            axios.get('/getimages').then((response) => {
                this.images = response.data
            }).catch((error) => {
                alert(error);
            })
        }
    }
}
</script>