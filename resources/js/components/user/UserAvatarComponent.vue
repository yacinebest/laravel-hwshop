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
                        <a href="#" onclick="document.getElementById('user-avatar').click();">
                            <img :src="'/storage/uploads/avatars/' +this.avatar" class="rounded-circle" id="avatar-upload-img" >
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
            authUser: this.user,
            avatar : this.user.avatar,
        };
    },
    methods: {
        uploadAvatar(event) {
            let selectedFile = event.target.files[0]
            let form = new FormData()
            form.append('avatar',selectedFile)
            form.append('user_id',this.authUser.id)

            axios.post('profile',form,{
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
            })
                .then( ({data}) => {
                    this.avatar = data
                    let oldPath = document.getElementById("avatar-upload-img").getAttribute('src')
                    let newPath = oldPath.substring(0, oldPath.lastIndexOf("/")) + "/" + this.avatar
                    document.getElementById('avatar-img').setAttribute('src',newPath)
                })
        }
    }
}
</script>
