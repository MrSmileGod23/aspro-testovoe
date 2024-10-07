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
            const response = await fetch('./function/brackets.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    //Передаем строку
                    string: this.string
                }),
            });

            const result = await response.text();
            const data = JSON.parse(result);

            //Если запрос успешный,то обнуляем ошибки,записываем результат и вызываем функцию обновления истории
            if (data.success) {
                this.error = null;
                this.result = data.success;
                this.fetchHistory();
            }
            //Если запрос неуспешный,то выводим сообщение об ошибке
            else {
                this.error = data.message;
            }
        },
        async fetchHistory() {
            const response = await fetch('./function/display.php');
            this.history = await response.json();
        },
    },

    created() {
        this.fetchHistory();
    },

    template: `
        <div>
                <div class="col mb-3">
                    <label for="string" class="form-label">Ваша строка</label>
                    <input type="text" v-model="string" class="form-control"  aria-describedby="inputStringHelp" value="">
                </div>
                <div class="text-center mt-5">
                    <button @click="checkBrackets" class="btn btn-primary">Отправить</button>
                </div>
            </div>
            <div v-if="result" >Результат: {{ result }}</div>
            <div v-if="error" >{{ error }}</div>
            
             <h4 class="text-center mb-5 mt-5">История запросов</h4>
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