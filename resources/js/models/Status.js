class Status {

    //this allows a clean way to add other functions

    static find(id) {
        return axios.get('/statuses/' + id);
    }

    static all(then) {
        return axios.get('/statuses')
            .then(({data}) => then(data))
        
    }
    
    // this would be valid in the older method in home.vue
    // static all() {
    //     return axios.get('/statuses')
        
    // }

}

export default Status;