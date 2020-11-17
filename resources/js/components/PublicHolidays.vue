<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white bg-primary text-center text-uppercase display-4">Public holidays</div>
                    <div>
                        <h3>Select a country:</h3>
                        <v-select :clearable="false" :options='country' v-model='selectedCountry'></v-select>
                        <h3>Select year:</h3>
                        <v-select :clearable="false" :options="year" v-model="selectedYear"></v-select>
                    </div>
                </div>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <router-link to="/" exact :disabled="true" class="nav-link active">Public holidays</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name:'Stats', params:{label: this.selectedLabel, year: selectedYear, code:selectedYear.code}}" class="nav-link">Statistics</router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Public holidays in {{this.selectedCountry.label}}:</h5>
                    </div>
                    <ul 
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Vue from 'vue'
import vSelect from 'vue-select'
    export default {
        components:{
            vSelect
        },
        mounted() {
            this.yearNow()
            this.fetchData()
        },
        watch: {
            selectedYear: {
                handler(newValue, oldValue) {
                    this.fetchData()
                },
                deep: true
            },
            selectedCountry: {
                handler(newValue, oldValue) {
                    this.fetchData()
                    this.setNewCountry()
                },
                deep: true
            },
        },
        data () {
            return {
                selectedCountry: {label: 'Lithuania', code: 'ltu'},
                selectedYear: this.yearNow(),
                country:[
                    {label: 'Angola', code: 'ago'},
                    // {label: 'Australia', code: 'aus'},  NOT WORKING
                    {label: 'Austria', code: 'aut'},
                    {label: 'Belgium', code: 'bel'},
                    {label: 'Bosnia and Herzegovina', code: 'bih'},
                    {label: 'Brazil', code: 'bra'},
                    {label: 'Canada', code: 'can'},
                    {label: 'Chile', code: 'chl'},
                    {label: 'China', code: 'chn'},
                    {label: 'Colombia', code: 'col'},
                    {label: 'Croatia', code: 'hrv'},
                    {label: 'Czech Republic', code: 'cze'},
                    {label: 'Denmark', code: 'dnk'},
                    {label: 'Estonia', code: 'est'},
                    {label: 'Finland', code: 'fin'},
                    {label: 'France', code: 'fra'},
                    {label: 'Germany', code: 'deu'},
                    {label: 'Greece', code: 'grc'},
                    {label: 'Hong Kong', code: 'hkg'},
                    {label: 'Hungary', code: 'hun'},
                    {label: 'Iceland', code: 'isl'},
                    {label: 'Ireland', code: 'irl'},
                    {label: 'Isle Of Man', code: 'imn'},
                    {label: 'Israel', code: 'isr'},
                    {label: 'Italy', code: 'ita'},
                    {label: 'Japan', code: 'jpn'},
                    {label: 'Korea (South)', code: 'kor'},
                    {label: 'Latvia', code: 'lva'},
                    {label: 'Lithuania', code: 'ltu'},
                    {label: 'Luxembourg', code: 'lux'},
                    {label: 'Macedonia', code: 'mkd'},
                    {label: 'Mexico', code: 'mex'},
                    {label: 'Netherlands', code: 'nld'},
                    {label: 'New Zealand', code: 'nzl'},
                    {label: 'Norway', code: 'nor'},
                    {label: 'Peru', code: 'per'},
                    {label: 'Philippines', code: 'phl'},
                    {label: 'Poland', code: 'pol'},
                    {label: 'Portugal', code: 'prt'},
                    {label: 'Romania', code: 'rou'},
                    {label: 'Russian Federation', code: 'rus'},
                    {label: 'Serbia', code: 'srb'},
                    {label: 'Singapore', code: 'sgp'},
                    {label: 'Slovakia', code: 'svk'},
                    {label: 'Slovenia', code: 'svn'},
                    {label: 'South Africa', code: 'zaf'},
                    {label: 'Sweden', code: 'swe'},
                    {label: 'Switzerland', code: 'che'},
                    {label: 'Turkey', code: 'tur'},
                    {label: 'Ukraine', code: 'ukr'},
                    {label: 'United Kingdom', code: 'gbr'},
                    {label: 'United States of America', code: 'usa'},
                ],
                randomColors: ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'],
                year: 
                    this.renderYear(),
                allData: [],
                month: 0,
                selectedLabel: 'LIETUVA',
            }
        },
        methods: {
            fetchData() {
                fetch(`https://kayaposoft.com/enrico/json/v2.0/?action=getHolidaysForYear&year=${this.selectedYear}&country=${this.selectedCountry.code}&holidayType=public_holiday`)
                .then(response => response.json())
                .then(data => {
                    this.allData = data
                })
            },

            renderYear() {
            let years = [];
                for (let $i=2011; $i<=2099; $i++) {
                    years.push($i);
                }
            return years;
            },

            yearNow() {
                return this.selectedYear = new Date().getFullYear();
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

            setNewCountry() {
                console.log(this.selectedLabel)
                this.$set(this.selectedLabel, this.selectedCountry.label)
                console.log(this.selectedLabel)
                return this.selectedLabel
            },

        },
    }
</script>
