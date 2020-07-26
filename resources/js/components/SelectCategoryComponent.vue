<template>
    <div>
        <!-- <label for="">{{ categories_level.data }}</label> -->
        <div v-for="(value,name) in categories_level" :key="name"  class="form-group">
            <div class="form-group" >
                <label>Level {{ name }}</label>
                <!-- <div v-for="(category,index)  in value" :key="index">
                            <p>{{ category.name }}</p>
                    </div> -->
                <select  :id="'select-'+ name " class="form-control select-option" @change="selectedOption" >
                    <option :id="'default-'+name"></option>
                    <option v-for="(category,index)  in value" :key="index" :value="category.id" >{{  category.name  }}</option>
                    <!-- <option v-for="(category,index)  in value" :key="index" :value="category" >{{  category.name  }}</option> -->
                </select>
                
            </div>  
        </div> 
    </div>
</template>

<script>
export default {
    mounted() {
        document.querySelectorAll('select[id^=select-]').forEach(element => {
                this.selectedObject[element.id]= {}
                this.lengthSelect++
        });
    },
    props:{
        categories_level: {
            type: Object,
            required: true,
            default: ()=>({})
        }
    },
    data() {
        return {
            selectedObject: ({}),
            categories: ({}),
            lengthSelect: 0
        }
    },
    methods: {
        selectedOption(e){
            let id = e.target.value 
            let selectId = e.target.id
            let currentIndex = selectId.substring(selectId.length, selectId.lastIndexOf("-")+1) 

            this.deselectAllOption( currentIndex)

            if(id===''){
                this.initElementSelectedObject(currentIndex)
                this.selectDefaultOption(currentIndex)
                this.enabledAboveSelect(currentIndex)
            }
            else{
                this.selectOption(id)

                this.fillSelectedObject(currentIndex,id)

                this.cleanAllSelectRefill(currentIndex)
            }
        },



        deselectAllOption(index){
            let options = Array.from(document.getElementById('select-' +index ).options)
            options.forEach(element => {
                element.removeAttribute('selected')
            });
        },

        selectOption(value){
            document.querySelector("option[value='"+value+"']").setAttribute('selected',true)
        },
        selectDefaultOption(index){
            document.getElementById("default-"+index).setAttribute('selected',true)
        },

        enabledSelect(index){
            document.getElementById('select-' + index).removeAttribute('disabled') 
        },
        enabledAboveSelect(index){
            let beforeIndex = index-1
            if( beforeIndex >0)
                this.enabledSelect(beforeIndex)   
        },
        disabledSelect(index){
            document.getElementById('select-' + index).setAttribute('disabled',true) 
        },

        initElementSelectedObject(index){
            this.selectedObject['select-' + index]={}
        },
        fillSelectedObject(currentIndex,id){
            for (let index = currentIndex ; index > 0 ; index--) {
                
                this.selectedObject['select-' + index] = this.categories.find(function(elem){
                                                    if(elem.id=== id)
                                                        return elem ;
                                                });

                id = this.selectedObject['select-' +index ].parent_id
            }
        },
        cleanAllSelectRefill(currentIndex){
            for (let index = currentIndex - 1 ; index > 0 ; index--) {
                this.deselectAllOption(index)
                let value = this.selectedObject['select-' + index].id
                this.selectOption(value)
                this.disabledSelect(index)
            }
        }

    },
    created() {
        axios.get('/category')
            .then( ({data}) => {
                this.categories = data
            })
    },
}
</script>
