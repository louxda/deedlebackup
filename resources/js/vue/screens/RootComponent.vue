<template>
    <!--<tutorial-component></tutorial-component>-->
    <!--<deedle-component></deedle-component>-->
    <component :is="currentView"></component>
</template>

<script>
import Tutorial from './TutorialComponent';
import Deedle from './DeedleComponent';

const routes = {
    '/': Tutorial,
    '/deedle': Deedle
}
export default {
    data() {
        return {
            currentPath: window.location.hash
        }
    },
    computed: {
        currentView() {
            return routes[this.currentPath.slice(1) || '/'] || NotFound
        }
    },
    mounted() {
        window.addEventListener('hashchange', () => {
            this.currentPath = window.location.hash
        })
        var watched = window.localStorage.getItem("hasWatchedTutorial");
        if (watched === "1") {
            window.location.hash = "/deedle";
        }

    }
}
</script>