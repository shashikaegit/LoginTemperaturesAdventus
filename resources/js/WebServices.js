import Vue from 'vue'
export default {
    storeRegister(formData) {
        return axios.post('register', formData)
            .then(response => {
                return response
            });
    },
    checkUserLoggedIn() {
        return axios.get('user/logged-in')
            .then(response => {
                return response;
            });
    },
    storeLogin(formData) {
        return axios.post('login', formData)
            .then(response => {
                return response
            });
    },
    fetchCityTemperature() {
        return axios.get('user/temperature')
            .then(response => {
                return response
            });
    },
}
