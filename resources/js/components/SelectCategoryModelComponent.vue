<template>
    <div>
        <div v-for="(value,name) in categories_level" :key="name"  class="form-group">
            <div class="form-group" >
                <label>Level {{ name }}</label>
                <select  :id="'select_'+ name " class="form-control" @change="selectedOption" v-model="selectedObject['select_' + name]">
                    <option :id="'default_'+name" :value="{}" selected></option>
                    <option v-for="(category,index)  in value" :key="index" :value="category" :id="category.id" >{{  category.name  }}</option>
                </select>
            </div>

        </div>
        <p>Selected {{ selected ? selected.name : '' }}</p>
    </div>
</template>

<script>
export default {
    mounted() {
        document.querySelectorAll('select[id^=select_]').forEach(element => {
                this.selectedObject[element.id]= {}
                this.lengthSelect++
        })
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
            lengthSelect: 0,
            selected: ({})
        }
    },
    computed: {
        nameCatagory(){
            return this.selectedObject['select_1'] ?  this.selectedObject['select_1'].name : ''
        },
    },
    methods: {
        // nameCatagory(selectId){
        //     return this.selectedObject['select_' + selectId] ?  this.selectedObject['select_' + selectId].name : ''
        // },

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
            // console.log(document.getElementById(value))
            // document.querySelector("option[value='"+value+"']").setAttribute('selected',true)
        },
        selectOptionFromEvent(e){

            let indexTable = e.target.options.selectedIndex
            // e.target.options[indexTable].setAttribute('selected',true)
            this.selectOption(e.target.options[indexTable].id)
            // document.querySelector("option[value='"+value+"']").setAttribute('selected',true)
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
        axios.get('/category')
            .then( ({data}) => {
                this.categories = data
            })
    },
}
</script>
