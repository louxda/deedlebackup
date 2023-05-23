import './bootstrap';
var moment = require('moment');
// Require Vue
import Vue from 'vue';


// Register Vue Components
Vue.component('root-component', require('./vue/screens/RootComponent.vue').default);
Vue.component('tutorial-component', require('./vue/screens/TutorialComponent.vue').default);
Vue.component('deedle-component', require('./vue/screens/DeedleComponent.vue').default);
Vue.component('timer-countdown-component', require('./vue/components/TimerCountdownComponent.vue').default);
Vue.component('deedle-stats-component', require('./vue/components/DeedleStatsComponent.vue').default);
Vue.component('deedle-support-component', require('./vue/components/DeedleSupportComponent.vue').default);
// Initialize Vue
const app = new Vue({
    el: '#app',
});
//
// var diffDays = Math.floor(diff / 86400000); // days
// var diffHrs = Math.floor((diff % 86400000) / 3600000); // hours
// var diffMins = Math.round(((diff % 86400000) % 3600000) / 60000);


// // On page load or when changing themes, best to add inline in `head` to avoid FOUC
// if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
//     document.documentElement.classList.add('dark')
// } else {
//     document.documentElement.classList.remove('dark')
// }
//
// // Whenever the user explicitly chooses light mode
// localStorage.theme = 'light'
//
// // Whenever the user explicitly chooses dark mode
// localStorage.theme = 'dark'
//
// // Whenever the user explicitly chooses to respect the OS preference
// localStorage.removeItem('theme')