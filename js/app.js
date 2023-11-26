const { createApp } = Vue;

createApp({
    data() {
        return{
            toDoList: [],
            newTask: '',
        }
    },
    mounted() {
        this.loadToDoList();
        console.log('To Do List' + this.toDoList);
    },
    methods: {
        loadToDoList(){
            axios.get('http://localhost:8888/Esercizi/php-todo-list-json/index.php', { headers: { 'Content-Type': 'multipart/form-data'}})
            .then(Response => {
                this.toDoList = Response.data;
            })
            .catch(Error => {
                console.error(Error);
            })

        },
        addTask(){
            if (this.newTask.trim() != '') {
                this.toDoList.push({
                    text : this.newTask,
                    done : false
                });
                console.log(this.toDoList);
                this.saveToDoList();
                this.newTask = '';
            }
        },
        saveToDoList(){
            axios.post('http://localhost:8888/Esercizi/php-todo-list-json/index.php', this.toDoList, { headers: { 'Content-Type': 'multipart/form-data'}})
            .then(Response => {
                console.log(Response);
            })
            .catch(Error => {
                console.error(Error);
            })
        },
        doneTask(index){
            this.toDoList[index].done = !this.toDoList[index].done;
            this.saveToDoList();
        }
    }
}).mount('#app');