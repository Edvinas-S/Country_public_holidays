<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white bg-primary text-center text-uppercase display-4">Public holidays</div>
                    <div>
                        <h3>Select a country:</h3>
                        <v-select :clearable="false" v-model='label'></v-select>
                        <h3>Select year:</h3>
                        <v-select :clearable="false" v-model='year'></v-select>
                    </div>
                </div>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <router-link to="/" class="nav-link ">Public holidays</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="" class="nav-link active">Statistics</router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Holidays statistics in {{label}}:</h5>
                    </div>
                    <!-- <ul 
                    v-for="(holiday, index) in allData" 
                    :key="index" 
                    class="list-group"
                        >
                        <li class="list-group-item" :style="`display:${ holiday.date.month == month ? 'none' : month=holiday.date.month }`">
                            <strong>{{toMonthName(holiday.date.month)}}</strong>
                        </li>
                        <li :class="`list-group-item list-group-item-${randomColors[getRandomInt(8)]}`">
                            {{holiday.date.day}} {{toMonthName(holiday.date.month)}} {{holiday.date.year}} ({{toDayOfWeek(holiday.date.dayOfWeek)}}) - {{holiday.name[0].text}} ({{holiday.name[1].text}})
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Vue from 'vue'
import vSelect from 'vue-select'
    export default {
        props: {
            label: {
                type: String,
                required: true
            },
            code: {
                type: String,
                required: true
            },
            year: {
                type: Number,
                required: true
            },
        },
        components:{
            vSelect
        },
        mounted() {
            this.fetchData()
        },
        data () {
            return {
                randomColors: ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'],
                allData: [],
            }
        },
        methods: {
            fetchData() {
                fetch(`https://kayaposoft.com/enrico/json/v2.0/?action=getHolidaysForYear&year=${this.year}&country=${this.code}&holidayType=public_holiday`)
                .then(response => response.json())
                .then(data => {
                    this.allData = data
                })
            },

            toDayOfWeek(number) {
                switch (number) {
                    case 1: return 'Monday';
                    case 2: return 'Tuesday';
                    case 3: return 'Wednesday';
                    case 4: return 'Thursday';
                    case 5: return 'Friday';
                    case 6: return 'Saturday';
                    case 7: return 'Sunday';
                    default: return 'What day is it? 	🤔';
                }
            },

            toMonthName(number) {
                switch (number) {
                    case 1: return 'JANUARY';
                    case 2: return 'FEBRUARY';
                    case 3: return 'MARCH';
                    case 4: return 'APRIL';
                    case 5: return 'MAY';
                    case 6: return 'JUNE';
                    case 7: return 'JULY';
                    case 8: return 'AUGUST';
                    case 9: return 'SEPTEMBER';
                    case 10: return 'OCTOBER';
                    case 11: return 'NOVEMBER';
                    case 12: return 'DECEMBER';
                    default: return 'What Month is it? 	🤔';
                }
            },

            getRandomInt(max) {
                return Math.floor(Math.random() * Math.floor(max));
            },

        },
    }
</script>
