<template>
    <div>
        <div class="media my-3" v-for="reply in replies.data" :key="reply.id" >

             <a class="mr-3" href="#">
                <avatar v-if="reply.username" :username="reply.username" class='mr-3' :size="30"></avatar>
            </a>

            <div class="media-body">
                <h6  v-if="reply.username" class="mt-0" >{{ reply.username  }}</h6>
                <small>{{ reply.body  }}</small>

                <div v-if="authuser!=''" >
                    <votes v-if="reply.user"  :authuser="authuser" :initvotes="reply.votes"  :entity_id="reply.id" :entity_owner="reply.user.id" entity_model="Comment"></votes>
                </div>
                <div v-else>
                    <votes v-if="reply.user" :initvotes="reply.votes"  :entity_id="reply.id" :entity_owner="reply.user.id" entity_model="Comment"></votes>
                </div>

            </div>

        </div>

        <div v-if="comment.repliesCount > 0 && replies.next_page_url " class="text-center">
            <button @click="fetchReplies"  class="btn btn-info btn-sm">
                Load Replies
            </button>
        </div>
    </div>
</template>

<script>
import Avatar from 'vue-avatar'
import Votes from './../votes/VotesComponent.vue'

export default {
    components: {
        Avatar,
        Votes
    },
    props:{
        comment: {
            type: Object,
            required: true,
            default: () => ({})
        },
        authuser: {
            type: String,
            default: ''
        }
    },
    mounted() {
        this.fetchReplies()
    },
    computed: {
        isAuth(){
            return this.authuser
        }
    },
    data() {
        return {
            replies : {
                data: [],
                next_page_url:  `/comments/${this.comment.id}/replies`
            }
        }
    },
    methods: {
        fetchReplies(){
            axios.get(this.replies.next_page_url,{
                        replies_id: this.replies.id,
                    }).then( ({data})=>{
                this.replies = {
                    ...data,
                    data : [
                        ...this.replies.data,
                        ...data.data
                    ]
                }

            } )
        },
        addReply(reply){
            this.replies = {
                ...this.replies,
                data: [
                    reply,
                    ...this.replies.data
                ]
            }
        }
    },
}
</script>
