<template>
    <div @click.self="$emit('openStats')"
         class="absolute top-0 left-0  bg-lightOverlayColor flex flex-col w-screen   pb-30  items-center backdrop-blur-md "
         style="height: calc(100vh); overflow-y: auto">
        <div class="flex flex-row items-center    mt-6  font-bold text-darkBackgroundColor text-3xl justify-around space-x-6 px-10 mb-6">
            <button @click="$emit('openSupport')" class="active:shadow"><img src="img/quetion_circle.svg" alt="" class=" w-6 h-6" /></button>
            <p>Deedle #{{ this.getTodaysDeedleNumber }}</p>
            <button @click="$emit('openStats')" class="active:shadow"><img src="img/stats_icon.svg" alt="" class="w-6 h-6" /></button>
        </div>
        <div class="flex flex-col bg-lightBackgroundColor border-2 border-darkBackgroundColor  w-11/12  py-5 px-4 md:w-1/2">
            <p class="text-xl text-center font-bold mb-4">Deedle stats</p>
            <div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor mb-6"></div>
            <p class="font-bold mb-3">Your stats</p>
            <div class="flex flex-col  space-y-4 mb-3">
                <div class="flex justify-between">
                    <p>Deedles done</p>
                    <p>{{ this.$props.stats.deedlesDone }}</p>
                </div>
                <div class="flex justify-between">
                    <p>Streak</p>
                    <p>{{ this.streak}}</p>
                </div>
                <div class="flex justify-between">
                    <p>Longest streak</p>
                    <p>{{this.longestStreak }}</p>
                </div>
            </div>
            <div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor mb-6"></div>
            <p class="font-bold mb-3">Global stats</p>
            <div class="flex flex-col  space-y-4 mb-3">
                <div class="flex justify-between">
                    <p>Daily deedler</p>
                    <p>#{{ this.dailyDeedler }}</p>
                </div>
                <div class="flex justify-between">
                    <p>Total deedles done</p>
                    <p>{{ this.totalDeedlesDone }}</p>
                </div>
            </div>
            <div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor mb-6"></div>
            <!--<p>See more at <a class="text-sky-400">deedlestats.com</a></p>-->
            <!--<div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor mb-6"></div>-->
            <p class="text-center mb-3">New deedle available in</p>
            <timer-countdown-component :datedFor="this.$props.nextDeedle.dated_for"></timer-countdown-component>
            <div class="flex space-x-2 justify-center ">

                <button @click="share" class=" flex-1 px-4 flex justify-center text-xs text-lightBackgroundColor bg-darkBackgroundColor  items-center py-2  ">
                    <img src="img/share_icon.svg" class="mr-3" />Share
                </button>
                <button @click="openLink"
                        class=" flex-1  px-4 justify-center flex text-xs  border-darkBackgroundColor active:bg-darkBackgroundColor active:text-lightBackgroundColor  border-4  py-2  items-center ">
                    <img src="img/support_icon.svg" class="mr-3" />Support deedle
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // name: "DeedleStatsComponent"
    props: {
        stats: Object,
        nextDeedle: Object,
        todaysDeedle: Object,
    },
    computed: {
        getTodaysDeedleNumber(){
            return this.todaysDeedle.challenge_number != null ? this.todaysDeedle.challenge_number :  this.todaysDeedle.id;
        },
        totalDeedlesDone() {
            return this.$props.stats.totalDeedlesDone != null ? this.$props.stats.totalDeedlesDone.toLocaleString() : "0";
        },
        dailyDeedler() {
            return this.$props.stats.dailyDeedlerCounts[this.todaysDeedle.id] != null ? this.$props.stats.dailyDeedlerCounts[this.todaysDeedle.id].toLocaleString() : "0";
        },
        streak(){
            let streak = this.$props.stats.deedlerStreak != null ? this.$props.stats.deedlerStreak["days_count"] : 0;
            return streak > 1 ? `${streak} days` : streak == 0 ? `0` : `${streak} day`;
        },
        longestStreak(){
            let streak = this.$props.stats.longestStreak != null ? this.$props.stats.longestStreak["days_count"] : 0;
            return streak > 1 ? `${streak} days` : streak == 0 ? `0` : `${streak} day`;
        }
    },
    methods: {
        openLink() {
            window.open(
                "https://www.buymeacoffee.com/deedle", "_blank");
        },
        share() {
            let streak = this.$props.stats.deedlerStreak != null ? this.$props.stats.deedlerStreak['days_count'] : '0';
            let shareText = `Deedle #${this.getTodaysDeedleNumber}\nDeedler #${this.dailyDeedler}\nStreak: ${streak}\n`;
            const shareData = {
                title: 'Deedle #' + this.getTodaysDeedleNumber,
                text: shareText,
                url: 'https://deedle.app'
            }

            navigator.share(shareData).then(function () {
            }).catch(function (er) {
            });


        }
    }
}
</script>

<style scoped>

</style>
