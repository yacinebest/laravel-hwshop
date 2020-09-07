<template>
    <div>
        <input type="hidden" name="parent_id" v-bind:value="selected.id" />
        <div v-if="Object.keys( this.current_category).length >0" class="form-group" >
            <label>Current Level : {{current_category.level}}</label>
        </div>
        <div v-for="(value,name) in categories_level" :key="name"  class="form-group">
            <div class="form-group" >
                <label>Level {{ name }}</label>
                <select   :id="'select_'+ name " class="form-control" @change="selectedOption" v-model="selectedObject['select_' + name]">
                    <option :id="'default_'+name" :value="{}" selected></option>
                    <option v-for="(category,index)  in value" :key="index" :value="category" :id="category.id" >{{  category.name  }}</option>
                </select>
            </div>

        </div>
        <p>Selected Parent {{ selected ? selected.name : '' }}</p>
    </div>
</template>

<script>
export default {
    mounted() {
        let select_id;
        document.querySelectorAll('select[id^=select_]').forEach(element => {
                if ( Object.keys( this.selected_categories).length >0 ){
                    select_id = element.id.substring(element.id.length, element.id.lastIndexOf("_")+1)
                    if (this.selected_categories.hasOwnProperty(element.id)) {
                        this.selectedObject[element.id]= this.selected_categories[element.id]
                        this.selectOption(this.selectedObject[element.id].id)
                        this.disabledSelect( select_id)
                    }
                    else{
                        this.selectedObject[element.id]= {}
                        this.enabledAboveSelect(select_id)
                    }
                }
                else
                    this.selectedObject[element.id]= {}

                this.lengthSelect++
        })

        this.enabledSelect(this.lengthSelect)

        let last_id = Object.keys( this.selected_categories).length
        if(last_id>0){
            this.selected = this.selected_categories['select_'+last_id]
        }

    },
    props:{
        categories_level: {
            type: Object,
            required: true,
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
    computed: {
    },
    methods: {
        selectedOption(e){
            let selectId = e.target.id
            let currentIndex = selectId.substring(selectId.length, selectId.lastIndexOf("_")+1)

            this.deselectAllOption(currentIndex)
            this.selectOptionFromEvent(e)
            this.setNameSelectd(e)


            if( Object.keys( this.selectedObject['select_' + currentIndex]).length != 0  ){
                let id = (this.selectedObject['select_' + currentIndex].parent_id) ? this.selectedObject['select_' + currentIndex].parent_id : null

                for (let index = currentIndex-1 ; index > 0 && id!=null ; index--) {
                    this.selectedObject['select_' + index] = this.categories.find(function(elem){
                                    if(elem.id=== id)
                                        return elem ;
                                });
                    this.deselectAllOption(index)
                    this.selectOption(this.selectedObject['select_' + index].id)
                    this.disabledSelect(index)
                    if(this.selectedObject['select_' + index].parent_id)
                        id = this.selectedObject['select_' + index].parent_id
                }
            }
            else{
                this.enabledAboveSelect(currentIndex)
            }
        },
        enabledSelect(index){
            document.getElementById('select_' + index).removeAttribute('disabled')
        },
        enabledAboveSelect(index){
            let beforeIndex = index-1
            if( beforeIndex >0)
                this.enabledSelect(beforeIndex)
        },
        disabledSelect(index){
            document.getElementById('select_' + index).setAttribute('disabled',true)
        },


        deselectAllOption(index){
            let options = Array.from(document.getElementById('select_' +index ).options)
            options.forEach(element => {
                element.removeAttribute('selected')
            });
        },

        selectOption(value){
            document.getElementById(value).setAttribute('selected',true)
        },
        selectOptionFromEvent(e){
            let indexTable = e.target.options.selectedIndex
            this.selectOption(e.target.options[indexTable].id)
        },
        selectDefaultOption(index){
            document.getElementById("default_"+index).setAttribute('selected',true)
        },

        setNameSelectd(e){
            let selectId = e.target.id
            let currentIndex = selectId.substring(selectId.length, selectId.lastIndexOf("_")+1)

            let indexTable = e.target.options.selectedIndex

            let id = e.target.options[indexTable].id


            this.selected = this.categories.find(function(elem){
                                if(elem.id=== id)
                                    return elem ;
                            }) || ({});

            if(Object.keys(this.selected).length==0 ){
                for (let index =1 ; index <=currentIndex  ; index++) {
                    if(Object.keys(this.selectedObject['select_'+index]).length==0){
                        let beforeIndex = index-1;
                        if( beforeIndex)
                            this.selected = this.selectedObject['select_'+beforeIndex] ;
                    }

                }
            }
        }
    },
    created() {
        axios.post('/allCategory')
            .then( ({data}) => {
                this.categories = data
            })
    },
}
</script>
