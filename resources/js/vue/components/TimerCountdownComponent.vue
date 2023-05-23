<template>

    <div class="flex flex space-x-4 justify-center mb-10">
        <div class=" h-16  w-16 rounded-md flex flex-col justify-center items-center   space-y-2 bg-darkBackgroundColor  text-lightBackgroundColor">
            <p>{{ this.timeRemaining.hours }}</p>
            <p style="font-size: 0.6rem">Hours</p>
        </div>
        <div class="h-16  w-16 rounded-md flex flex-col justify-center items-center space-y-2 bg-darkBackgroundColor  text-lightBackgroundColor">
            <p>{{ this.timeRemaining.minutes }}</p>
            <p style="font-size: 0.6rem">Minutes</p>
        </div>
        <div class="h-16 w-16 rounded-md flex flex-col justify-center items-center space-y-2 bg-darkBackgroundColor  text-lightBackgroundColor">
            <p>{{ this.timeRemaining.seconds }}</p>
            <p style="font-size: 0.6rem">Seconds</p>
        </div>
    </div>

</template>

<script>

import moment from "moment";

export default {
    props: {
        datedFor: String
    },
    data() {
        return {
            timeRemaining: {},
            interval: null
        }
    },
    mounted() {
        this.interval = setInterval(this.updateTimer, 1000);
    },
    computed: {},
    methods: {
        updateTimer() {
            let startTime = moment();
            let endTime = moment(this.$props.datedFor);
            let duration = moment.duration(endTime.diff(startTime));
            // console.log(startTime, endTime, duration);

            this.timeRemaining = {
                hours: duration.hours(),
                minutes: duration.minutes(),
                seconds: duration.seconds()
            };
            if (this.timeRemaining.hours === 0 && this.timeRemaining.minutes === 0 && this.timeRemaining.seconds === 0) {
                clearInterval(this.interval);
            }
        }


    }
}
</script>
