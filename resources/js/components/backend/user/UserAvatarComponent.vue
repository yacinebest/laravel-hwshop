<template>
    <div >
        <div v-if="!upload"  class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
                    <img :src="'/storage/uploads/avatars/' + this.avatar" id="avatar-img" >
            </span>
            <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ this.username }}</span>
            </div>
        </div>
        <div v-else>
             <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <input type="file" class="d-none" name="avatar" id="user-avatar" refs="avatar" @change="uploadAvatar" >
                        <a onclick="document.getElementById('user-avatar').click();">
                            <img  id="avatar-upload-img" :src="this.src" class="rounded-circle w-100" >
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    name: 'user',
     props:{
        user: {
            type: Object,
            required: true,
            default: ()=>({})
        },
        upload: {
            type: Boolean,
            default: false
        },
        username: {
            type: String,
            required: false,
            default: ''
        }
    },
    data() {
        return {
            authuser: this.user,
            avatar : this.user.avatar,
            storage_folder: '/storage/uploads/avatars/',
            src:  '/storage/uploads/avatars/'  + this.user.avatar
        };
    },
    methods: {
        uploadAvatar(event) {
            let selectedFile = event.target.files[0]
            let form = new FormData()
            form.append('avatar',selectedFile)
            form.append('user_id',this.authuser.id)

            // let url = '/management/profile'
            let url = '/profile/avatar'
            axios.post(url,form,{
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
            })
                .then( ({data}) => {
                    this.avatar = data
                    this.src = this.storage_folder + this.avatar
                })
        }
    }
}
</script>
