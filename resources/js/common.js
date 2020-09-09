export default {
    data() {
        return {
            
        }
    },
    computed: {
        
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

 // async created() {
        //     const res = await this.callAPI('post', '/addTag', {tagName: 'test'});
        //     console.log(res);
        //     if(status == 200){
        //         console.log(res);
        //     }
        // },