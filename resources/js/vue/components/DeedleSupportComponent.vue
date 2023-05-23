<template>
    <div @click.self="$emit('openSupport')"
         class="absolute top-0 left-0  bg-lightOverlayColor flex flex-col w-screen h-screen space-y-20  pb-30  items-center backdrop-blur-md">
        <div class="flex flex-row items-center    mt-10  font-bold text-darkBackgroundColor text-3xl justify-around space-x-6 px-10">
            <button @click="$emit('openSupport')" class="active:shadow"><img src="img/quetion_circle.svg" alt="" class=" w-6 h-6" /></button>
            <p>Deedle #{{ this.getTodaysDeedleNumber }}</p>
            <button @click="$emit('openStats')" class="active:shadow"><img src="img/stats_icon.svg" alt="" class="w-6 h-6" /></button>
        </div>
        <div class="flex flex-col bg-lightBackgroundColor border-2 border-darkBackgroundColor  w-11/12  py-5 px-4">
            <p class="text-xl text-center font-bold mb-4">Deedle Support</p>
            <div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor mb-6"></div>
            <div class="flex flex-col  space-y-4 mb-3">
                <div class="flex justify-between">
                    <p>Questions?</p>
                    <a href="mailto:support@deedle.app" class="text-sky-400"> support@deedle.app</a>
                </div>
                <div class="flex justify-between">
                    <p>Community</p>
                    <a href="http://twitter.com/deedleapp" target="_blank" class="text-sky-400">twitter.com/deedleapp</a>
                </div>
                <div class="flex justify-between">
                    <p>Support Deedle</p>
                    <a href="https://www.buymeacoffee.com/deedle" target="_blank" class="text-sky-400">buymeacoffee</a>
                </div>
                <!--<div class="flex justify-between">-->
                <!--    <p>More Stats</p>-->
                <!--    <a class="text-sky-400">deedlestats.com</a>-->
                <!--</div>-->
            </div>
            <div class="flex justify-center items-center mt-10">
                <button @click="$emit('openSupport')"
                        class="px-4  w-64 flex-shrink text-xs  border-darkBackgroundColor active:bg-darkBackgroundColor active:text-lightBackgroundColor  border-4  py-2">
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // name: "DeedleSupportComponent"
    props:{
        todaysDeedle: Object
    },
    computed:{
        getTodaysDeedleNumber(){
            return this.todaysDeedle.challenge_number != null ? this.todaysDeedle.challenge_number :  this.todaysDeedle.id;
        },
    }
}
</script>

<style scoped>

</style>