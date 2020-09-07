<template>
    <div>

    </div>
</template>

<script>
export default {
     props:{
        categories_level: {
            type: Object,
            // type: Object,
            // required: true,
            // default: ()=>({})
            default: ()=>({})
        },
        selected_categories: {
            type: Object,
            default: ()=>({})
        },
        current_category: {
            type: Object,
            default: ()=>({})
        },
    },
     data() {
        return {
            selectedObject: ({}),
            categories: ({}),
            lengthSelect: 0,
            selected: ({})
        }
    },
     created() {
        // axios.post('/allCategory')
        //     .then( ({data}) => {
        //         console.log(data)
        //         this.categories = data
        //     })
    },
}
</script>

