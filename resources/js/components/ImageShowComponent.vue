<template>
    <div class="card shadow">

        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Images For {{ this.category.name }} :</h3>
                </div>
                <div class="col-4 text-right">
                    <input id="input-file" type="file" name="images[]" class="d-none" @change="uploadImages" multiple>
                    <!-- <button type="button" class="btn btn-sm btn-primary" @click="document.getElementById('input-file').click()">Upload New Images</button> -->
                    <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('input-file').click();">Upload New Images</button>
                </div>
            </div>
        </div>

        <div class="col-12">
        </div>

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Type</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="image in currentImages" :key="image.id">
                        <td>
                            <div class="images-preview">
                                <div class="img-wrapper" >
                                    <img :src="`/storage/uploads/categories/${image.file}`" :alt="`Category ${image.file}`" width="200" height="200">
                                </div>
                            </div>
                        </td>
                        <td>{{image.imageable_type}}</td>
                        <td><button type="button" class="btn btn-danger" @click="deleteImage(image)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        images: {
            type: Array,
            required: true,
            default: ()=>([])
        },
        category: {
            type: Object,
            required: true,
            default: ()=>({})
        },
    },
    data() {
        return {
            currentImages: this.images
        }
    },
    methods: {
        deleteImage(image){
            axios.delete(`/image/${image.id}`)
                .then( ({data}) => {
                    this.currentImages.splice(this.currentImages.indexOf(image), 1);
                })
        },
        uploadImages(e){
            const files = e.target.files;

            let form = new FormData()
            form.append('category_id',this.category.id)
            Array.from(files).forEach(file => {
                form.append('images[]', file, file.name);
            });

            axios.post('/image',form,{
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
            })
                .then( ({data}) => {
                    this.currentImages = data
                })

        },

    },
}
</script>
