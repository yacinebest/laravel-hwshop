<template>
    <div class="card mt-5 p-5">

         <div v-if="this.isAuth" class="form-inline my-4 w-full justify-content-center">
            <input v-model="newComment" type="text" class="form-control form-control-sm w-75"/>
            <button @click="addComment" class="btn btn-sm btn-primary">
                <small>Add Comment</small>
            </button>
        </div>

        <div v-if="this.isAuth" >
            <comment v-for="comment in comments.data" :key="comment.id" :comment="comment" :product="product" :authuser="isAuth" ></comment>
        </div>
        <div v-else>
            <comment v-for="comment in comments.data" :key="comment.id" :comment="comment" :product="product"></comment>
        </div>

        <div class="text-center">
            <button v-if="this.comments && this.comments.next_page_url" @click="fetchComments" class="btn btn-success">
                Load More
            </button>
            <span v-else>No more comments to show</span>
        </div>


    </div>
</template>

<script>
import Comment from './CommentComponent.vue'

export default {
    components: {
        Comment
    },
    props:{
        product:{
            type: Object,
            required: true,
            default: () => ({})
        },
        authuser: {
            type: String,
            default: ''
        }
    },
    computed: {
        isAuth(){
            return this.$attrs && this.$attrs.authuser
        }
    },
    mounted() {
        this.fetchComments()
    },
    data() {
        return {
            comments:{
                data: []
            },
            newComment: ''
        }
    },
    methods: {
        fetchComments(){
            const url = this.comments.next_page_url ? this.comments.next_page_url : `/products/${this.product.id}/comments`
            axios.get(url,{
                        product_id: this.product.id,
                    }).then( ({data})=>{
                this.comments = {
                    ...data,
                    data : [
                        ...this.comments.data,
                        ...data.data
                    ]
                }
            } )
        },
        addComment(){
            if(this.isAuth){
                if(! this.newComment)
                    alert("You can't add an Empty Comment !")
                else{
                    axios.post(`/comments/${this.product.id}`,{
                        product_id: this.product.id,
                        body: this.newComment

                    }).then( ({data})=>{
                        this.comments = {
                            ...this.comments,
                            data: [
                                data,
                                ...this.comments.data,

                            ]
                        }
                        this.newComment = ''
                    })
                }
            }
            else
                alert("Please Login to Add Commnet !")
        }
    },
};
</script>
