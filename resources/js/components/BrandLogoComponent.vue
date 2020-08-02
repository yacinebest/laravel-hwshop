<template>
    <div >
        <div v-if="!upload"  class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
                    <img :src="'/storage/uploads/logo/' + this.logo" id="logo-img" >
            </span>
        </div>
    </div>
</template>

<script>

export default {
     props:{
        entity: {
            type: Object,
            // required: true,
            default: ()=>({})
        },
        upload: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            logo : this.entity ? this.entity.logo : 'default-logo.jpg' ,
            name : this.entity.name,
        };
    },
}
</script>
