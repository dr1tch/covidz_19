export default {
    data() {
        return {
            
        }
    },
    computed: {
        capitalize(string) {
           return string.charAt(0).toUpperCase() + string.slice(1);
        },
    },
    methods: {
        
        callAPI (method, url, data=null){
          return new Promise((resolve, reject) => {
            axios[method](url, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
          });
        }
    },
}