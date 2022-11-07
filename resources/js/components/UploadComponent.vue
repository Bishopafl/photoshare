<template>
    <div>
        <form enctype="multipart/form-data" method="post">
            <div class="form-group text-center" ref="fileform">
                <input type="file" name="" ref="file" multiple="multiple" id="uploadImage">
                <span id="val"></span>
                <a class="btn btn-secondary" @click.prevent="submitFiles()">Upload</a>
            </div>
        </form>
    </div>
</template>

<script type="text/javascript">
export default {
    data() {
        return {

        }
    },
    methods: {
        submitFiles() {
            alert('yo');
        }
    }
}
</script>