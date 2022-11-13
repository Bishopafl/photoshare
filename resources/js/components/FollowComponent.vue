<template>
    <div>
        <button 
            class="btn btn-primary mt-3 ml-4"
            @click.prevent="followUser"
            v-text="buttonText"
        ></button>
    </div>
</template>

<script type="text/javascript">
import axios from 'axios';

export default {
    props:['userId', 'follows'],
    data() {
        return {
            status: this.follows
        }
    },
    methods: {
        followUser() {
            axios.post('/follow', {
                userId: this.userId
            }).then((response) => {
                console.log(response);
                this.status = !this.status
            }).catch((error) => {
                alert(error);
            })
        }
    },
    computed: {
        buttonText() {
            return(this.status) ? 'Unfollow' : 'Follow';
        }
    }
}
</script>