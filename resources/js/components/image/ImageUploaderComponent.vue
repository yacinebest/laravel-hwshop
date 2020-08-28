<template>
    <div>
        <label for="upload-images">Upload Images</label>
        <div class="uploader"
            @dragenter="onDragEnter"
            @dragleave="onDragLeave"
            @dragover.prevent
            @drop="onDrop"
            :class="{ dragging: isDragging  }">

            <div class="upload-control" v-show="images.length">
                <label for="file">Select a file</label>
                <button @click="upload">Upload</button>
            </div>

            <div v-show="!images.length">
                <i class="fa fa-cloud-upload"></i>
                <p>Drag Your Images Here :</p>
                <div>OR</div>
                <div class="file-input">
                    <label for="file">Select a File</label>
                    <input type="file" id="file" name="images[]" @change="onInputChange" multiple>
                </div>
            </div>
            <div class="images-preview" v-show="images.length">
                <div class="img-wrapper" v-for="(image,index) in images" :key="index">
                    <img :src="image" :alt="`Image Uploder ${index}`">
                    <div class="details">
                        <span class="name" v-text="files[index].name"></span>
                        <span class="size" v-text="files[index].size"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isDragging : false,
            dragCount: 0,
            files: [],
            images: [],
        }
    },
    methods: {
        onDragEnter(e){
            e.preventDefault();
            this.dragCount++
            this.isDragging = true
        },
        onDragLeave(e){
            e.preventDefault();
            this.dragCount--

            if(this.dragCount<=0)
                this.isDragging = false
        },
        onInputChange(e){

            const files = e.target.files;

            Array.from(files).forEach(file => this.addImage(file))
        },
        onDrop(e){
            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false

            const files = e.dataTransfer.files;

            Array.from(files).forEach(file => this.addImage(file))
        },

        addImage(file){
            if(!file.type.match('image.*')){
                console.log(`${file.name} is not an image`)
                return
            }

            this.files.push(file)

            const reader = new FileReader()

            reader.onload = (e) => this.images.push(e.target.result)
            reader.readAsDataURL(file)
        },




        upload(){
            const formData = new FormData();

            this.files.forEach(file => {
                formData.append('images[]', file, file.name);
            });
            axios.post('/images-upload', formData)
                .then(response => {
                    this.$toastr.s('All images uplaoded successfully');
                    this.images = [];
                    this.files = [];
                })
        }

    }
}
</script>
