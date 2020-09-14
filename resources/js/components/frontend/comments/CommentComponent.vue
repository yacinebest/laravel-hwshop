<template>
    <div class="media my-3">
        <avatar v-if="comment.user" :username="comment.username" class="mr-3" :size="30"></avatar>

        <div class="media-body">
            <h6 class="mt-0" v-if="comment.username">{{ comment.username }}</h6>
            <small>{{ comment.body }}</small>



            <div v-if="this.isAuth" class="d-flex">
                <votes v-if="comment.user"  :authUser="isAuth" :initvotes="comment.votes"  :entity_id="comment.id" :entity_owner="comment.user.id" entity_model="Comment"></votes>
                <button @click="showFormReply" class="btn btn-sm ml-2" :class="{ 'btn-primary': !addingReply,'btn-danger':addingReply }" >{{ !this.addingReply ? 'Add Reply' : 'Cancel'  }}</button>
            </div>
            <div v-else>
                <votes v-if="comment.user" :initvotes="comment.votes"  :entity_id="comment.id" :entity_owner="comment.user.id" entity_model="Comment"></votes>
            </div>

            <div v-if="addingReply" class="form-inline my-4 w-full">
                <input v-model="body" type="text" class="form-control form-control-sm w-50"/>
                <button @click="addReply" class="btn btn-sm btn-primary">
                    <small>Add Reply</small>
                </button>
            </div>


            <div v-if="this.isAuth" >
                <replies ref="replies" :comment="comment" :authUser="isAuth"></replies>
            </div>
            <div v-else>
                <replies ref="replies" :comment="comment"></replies>
            </div>


        </div>
    </div>
</template>

<script>
import Avatar from 'vue-avatar'
import Votes from './../votes/VotesComponent.vue'
import Replies from './RepliesComponent.vue'

export default {
     components: {
        Avatar,
        Replies,
        Votes
    },
    data() {
        return {
            addingReply : false,
            body: ''
        }
    },
    props:{
        comment:{
            type: Object,
            required: true,
            default: () => ({})
        },
        product:{
            type: Object,
            required: true,
            default: () => ({})
        },
        authUser: {
            type: String,
            default: ''
        }
    },
     computed: {
        isAuth(){
            return this.authUser
        }
    },
    methods: {
        showFormReply(){
            this.addingReply = !this.addingReply
        },
        addReply(){
             if(this.isAuth){
                if(! this.body)
                    alert("You can't add an Empty Comment !")
                else{
                    axios.post(`/comments/${this.product.id}`,{
                        product_id: this.product.id,
                        parent_id: this.comment.id,
                        body: this.body
                    }).then( ({data})=>{
                        this.body = ''
                        this.showFormReply()
                        this.$refs.replies.addReply(data)
                    })
                }
             }
             else
                alert("Please Login to Add Commnet !")




        }
    },
}
</script>
