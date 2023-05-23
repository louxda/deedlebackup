<template>
    <div class="">
        <div v-if="loading === false" class=" h-screen">
            <div class="flex flex-col mx-10 justify-between  mb-30  h-4/5 pb-20 items-center z-10">
                <div class="flex flex-row items-center  mt-10  font-bold text-darkBackgroundColor text-3xl  justify-around space-x-6">
                    <button @click="openSupport" class="active:shadow"><img src="img/quetion_circle.svg" alt="" class=" w-6 h-6" /></button>
                    <p>Deedle #{{ this.getTodaysDeedleNumber }}</p>
                    <button @click="openStats" class="active:shadow"><img src="img/stats_icon.svg" alt="" class=" w-6 h-6" /></button>
                </div>
                <h1 class="text-3xl text-center">{{ this.todaysDeedle.title }}</h1>
                <button v-if="deedleCompleted === false" @click="changeDeedleDone"
                        class=" p-2 px-5  bg-darkBackgroundColor text-lightBackgroundColor mb-10 active:border-2 active:border-darkBackgroundColor active:bg-lightBackgroundColor active:text-darkBackgroundColor">Deedle Done
                </button>
                <button v-if="deedleCompleted === true"
                        class=" p-2 px-5  bg-darkBackgroundColor text-lightBackgroundColor mb-10 active:border-2 active:border-darkBackgroundColor active:bg-lightBackgroundColor active:text-darkBackgroundColor">Deedle has been Completed
                </button>
            </div>

            <div v-if="revealDeedle"
                 class="absolute top-0 left-0  bg-lightOverlayColor flex flex-col w-screen h-screen space-y-20  pb-30  px-10  pb-20 items-center backdrop-blur-md">
                <div class="flex flex-row items-center flex-shrink  mt-10  font-bold text-darkBackgroundColor text-3xl justify-around space-x-6">
                    <button @click="openSupport" class="active:shadow"><img src="img/quetion_circle.svg" alt="" class=" w-6 h-6" /></button>
                    <p>Deedle #{{this.getTodaysDeedleNumber }}</p>
                    <button @click="openStats" class="active:shadow"><img src="img/stats_icon.svg" alt="" class="w-6 h-6" /></button>
                </div>
                <div class="flex flex-grow justify-center flex-col w-64">
                    <button @click="closeRevealDeedle"
                            class="w-full bg-lightBackgroundColor border-darkBackgroundColor active:bg-darkBackgroundColor active:text-lightBackgroundColor  border-4 flex justify-center items-center py-2 font-bold">Reveal The Deedle
                    </button>
                </div>
            </div>

            <div v-if="deedleDoneDialog" class="absolute w-screen h-screen top-0 left-0  bg-lightOverlayColor  backdrop-blur-md">
                <div class="flex flex-row items-center  mt-10  font-bold text-darkBackgroundColor text-3xl  justify-around space-x-6">
                    <button @click="openSupport" class="active:shadow"><img src="img/quetion_circle.svg" alt="" class=" w-6 h-6" /></button>
                    <p>Deedle #{{this.getTodaysDeedleNumber }}</p>
                    <button @click="openStats" class="active:shadow"><img src="img/stats_icon.svg" alt="" class=" w-6 h-6" /></button>
                </div>
                <div class="absolute bottom-0 left-0 w-screen h-1/2 bg-lightBackgroundColor rounded-t-[15px] ">
                    <div class="flex justify-end pr-4 pt-4">
                        <button @click="changeDeedleDone"><img src="img/close_icon.svg" alt=""></button>
                    </div>
                    <form ref="form" action="/deedle-completed" method="post">
                        <!--<input type="hidden" name="_token" :value="csrf">-->
                        <input name="deedleId" v-model:value="this.todaysDeedle.id" class="hidden">

                    </form>
                    <div class="flex flex-col mt-10 items-center space-y-24">
                        <p class="text-2xl">Deedle Done?</p>

                        <div class="flex flex-col space-y-4">
                            <button @click="changeDeedleDone"
                                    class="border-darkBackgroundColor active:bg-darkBackgroundColor active:text-lightBackgroundColor  border-4 flex justify-center items-center py-2  w-64">Not Yet
                            </button>
                            <button @click="completeDeedle"
                                    class="bg-darkBackgroundColor text-lightBackgroundColor  border-4 border-darkBackgroundColor flex justify-center items-center py-2  w-64">Confirmed!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <deedle-stats-component
                    v-if="this.statsOpen"
                    @openStats="openStats"
                    @openSupport="openSupport"
                    :stats="this.deedlerData.stats"
                    :nextDeedle="this.nextDeedle"
                    :todaysDeedle="this.todaysDeedle"
            ></deedle-stats-component>
            <deedle-support-component
                    v-if="this.supportOpen"
                    @openStats="openStats"
                    @openSupport="openSupport"
                    :todaysDeedle="this.todaysDeedle"
            ></deedle-support-component>
        </div>
        <div v-if="loading === true" class="flex justify-center items-center h-screen">
            <svg class="inline w-10 h-10 mr-2 text-gray-200 animate-spin dark:fill-lightBackgroundColor fill-darkBackgroundColor"
                 viewBox="0 0 100 101"
                 fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                      fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                      fill="currentFill" />
            </svg>
        </div>
    </div>

</template>

<script>

import moment from "moment";

export default {
    data() {
        return {
            deedlerData: globalData,
            revealDeedle: true,
            todaysDeedle: null,
            nextDeedle: null,
            deedleDoneDialog: false,
            statsOpen: false,
            supportOpen: false,
            deedleCompleted: false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            loading: false,
        }
    },
    created() {
        for (let i = 0; i < this.deedlerData.deedles.length; i++) {
            if (moment(this.deedlerData.deedles[i].dated_for).day() == new Date().getDay()) {
                this.todaysDeedle = this.deedlerData.deedles[i];
            } else if (moment(this.deedlerData.deedles[i].dated_for).day() == moment(new Date().toDateString()).add(1, "days").day()) {
                this.nextDeedle = this.deedlerData.deedles[i];
            }
        }
    },
    mounted() {


        if (this.todaysDeedle === null) {
            this.deedleCompleted = true;
            this.revealDeedle = false;
            this.statsOpen = true;
            return;
        }
        // console.log(moment(this.todaysDeedle.dated_for).day());
        if (this.todaysDeedle.has_completed === true || (moment(this.todaysDeedle.dated_for).day() !== new Date().getDay())) {
            this.deedleCompleted = true;
            this.revealDeedle = false;
            this.statsOpen = true;
        }
        // console.log(this.todaysDeedle, this.nextDeedle)
    },
    computed: {
        getTodaysDeedleNumber(){
            return this.todaysDeedle.challenge_number != null ? this.todaysDeedle.challenge_number :  this.todaysDeedle.id;
        }
    },
    methods: {
        changeDeedleDone() {
            this.deedleDoneDialog = !this.deedleDoneDialog;
        },
        closeRevealDeedle() {
            this.revealDeedle = !this.revealDeedle;
        },
        completeDeedle() {
            this.$refs.form.submit();
            // this.deedleCompleted = true;
            // this.statsOpen = !this.statsOpen;
        },
        openStats() {
            this.statsOpen = !this.statsOpen;
        },
        openSupport() {
            this.supportOpen = !this.supportOpen;
        },
    }
}
</script>
