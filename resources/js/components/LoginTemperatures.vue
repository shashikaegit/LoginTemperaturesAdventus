<template>
    <div class="row">
        <div class="col-md-12"><h1>Login Temperatures</h1></div>

        <div class="col-md-6" v-for="(value,key) in list">
            <h2>{{key}}</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Celsius</th>
                        <th scope="col">Fahrenheit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="val in value">
                        <th scope="row">{{val.created_at}}</th>
                        <th scope="row">{{val.celsius}}&#176;C</th>
                        <th scope="row">{{val.fahrenheit}}&#176;F</th>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import WebServices from '../WebServices';
export default {
    name: "LoginTemperatures",
    data : function (){
        return {
            list: {}
        }
    },
    methods : {
        listItems()
        {
            WebServices.fetchCityTemperature()
                .then(response => {
                    this.list = response.data;
                });
        }
    },
    mounted(){
        this.listItems();
    }
}
</script>

<style scoped>

</style>
