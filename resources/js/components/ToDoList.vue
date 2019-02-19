<template>
    <div class="row">
        <div class="col-md-12 header">
            <h1>To Do List</h1>
            <form class="form" @submit.prevent="">
                <input type="email" class="form__field" placeholder="Title..."  v-model="inputField" />
                <button type="button" class="btn btn--primary btn--inside uppercase" @click="addItem">Add</button>
            </form>
        </div>
        <div class="col-md-12 items" v-for="(item, index) in items" :key="item.id">
            <div class="item" :class="getCheckedClass(item.is_checked)" @click="noteItem($event, index, item.id)"><i class="fas fa-check"></i> <span> {{ item.value }} </span>  <div><i class="fas fa-times" @click="deleteItem(index, item.id)"></i></div></div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                items: {},
                inputField: '',
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get('items')
                    .then(({ data }) => {
                        this.items = data.data;
                    });
            },
            addItem() {
                if(this.inputField !== '') {
                    axios.post('items', {value: this.inputField})
                        .then(({data}) => this.items.push( data.data ));
                }
            },
            getCheckedClass (status) {
                return +status ? 'checked' : '';
            },
            noteItem(e, index, id) {
                if(e.target.classList.contains('item')){
                    axios.put('items/' + id);
                    this.items[index].is_checked = !(+this.items[index].is_checked) ? 1 : 0;
                }
            },
            deleteItem(index, id) {
                axios.delete('items/' + id);
                this.items.splice(index, 1);
            },
        }
    }
</script>