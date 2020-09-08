<template>
    <div class="row justify-content-center">
        <!-- <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <input type="file" class="d-none" name="avatar" id="user-avatar" refs="avatar" @change="upload" >
                <a href="#" onclick="document.getElementById('user-avatar').click();">
                    <img :src="'/storage/uploads/avatars/' +this.avatar" class="rounded-circle" >
                </a>
            </div>
        </div> -->
    </div>
</template>

<script>
export default {
    // name: 'user',
    // props:{
    //     user: {
    //         type: Object,
    //         required: true,
    //         default: ()=>({})
    //     }
    // },
    // data() {
    //     return {
    //         avatar : this.user.avatar,
    //     };
    // },
    // methods: {
    //     upload(event) {
    //         let selectedFile = event.target.files[0]
    //         let form = new FormData()
    //         form.append('avatar',selectedFile)
    //         form.append('user_id',this.user.id)

    //         axios.post('/management/profile',form,{
    //              headers: {
    //                     "Content-Type": "multipart/form-data"
    //                 },
    //         })
    //             .then( ({data}) => {
    //                 // this.avatar = data
    //             })
    //     }
    // }
};
</script>
