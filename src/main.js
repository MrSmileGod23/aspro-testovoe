const App = {
    data() {
        return {
            string: '',
            result: null,
            error: null,
            history: [],
        };
    },
    methods: {
        //Создаем ассинхроннный метод
        async checkBrackets() {
            //Отправляем POST запрос в функцию brackets
            const response = await fetch('src/Controllers/HistoryController.php?action=checkBrackets', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    //Передаем строку
                    string: this.string
                }),
            });
            const data = await response.json();

            //Если запрос успешный,то обнуляем ошибки,записываем результат и вызываем функцию обновления истории
            if (data.success) {
                this.error = null;
                this.result = data.success;
                this.fetchHistory();
            }
            //Если запрос неуспешный,то выводим сообщение об ошибке
            else {
                this.result = null;
                this.error = data.error;
            }
        },
        async deleteHistory(){
            const response = await fetch('src/Controllers/HistoryController.php?action=deleteHistory')
            this.fetchHistory();
        },
        async fetchHistory() {
            const response = await fetch('src/Controllers/HistoryController.php?action=getHistory');
            const data = await response.json();
            this.history = data;
            this.error = data.error;
        },
    },

    created() {
        this.fetchHistory();
    },

    template: `
        <div>
        <form @submit.prevent="checkBrackets">
            <div class="col mb-3">
                <label for="string" class="form-label">Ваша строка</label>
                <input type="text" v-model="string" class="form-control"  aria-describedby="inputStringHelp" value="">
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
       
        </form>
          </div>
            <div v-if="result" class="text-success">Результат: {{ result }}</div>
            <div v-if="error" class="text-danger" >{{ error }}</div>
            
             <h4 class="text-center mb-3 mt-5">История запросов</h4>
             <div class="text-center">
                <button @click.prevent="deleteHistory" class="btn btn-danger mb-5">Очистить</button>    
            </div>       
             <table class='table'>
             <thead>
                 <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Строка</th>
                    <th scope='col'>Результат</th>
                 </tr>
             </thead>
             <tbody>
                 <tr v-for="item in history" :key="item.id">   
               
                        <td>{{ item.id }}</td>
                        <td>{{ item.string }}</td>
                        <td>{{ item.status }}</td>
                
                  </tr>
              </tbody>
              </table>
    `,
};

Vue.createApp(App).mount('#app');