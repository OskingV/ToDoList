<template>
    <div class="row">
        <div class="col-md-12 header">
            <h1>To Do List</h1>
            <form class="form" @submit.prevent="">
                <input type="email" class="form__field" placeholder="Title..."  v-model="inputField" />
                <button type="button" class="btn btn--primary btn--inside uppercase" @click="addItem">Add</button>
            </form>
        </div>
        <div class="col-md-12 items" v-for="(item, index) in items">
            <div class="item" :class="item.checkedClass" @click="noteItem(index)"><i class="fas fa-check"></i> <span> {{ item.value }} </span>  <div><i class="fas fa-times" @click="deleteItem(index)"></i></div></div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                items: [],
                inputField: '',
            };
        },

        methods: {
            addItem() {
                if(this.inputField !== '') this.items.push({
                    value: this.inputField,
                    checkedClass: '',
                });
            },
            noteItem(index) {
                this.items[index].checkedClass = !this.items[index].checkedClass ? 'checked' : '';
            },
            deleteItem(index) {
                this.items.splice(index, 1);
            },
        }
    }
</script>