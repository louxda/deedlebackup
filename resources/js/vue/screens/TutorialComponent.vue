<template>
    <div class="px-10 space-y-14 md:w-1/2 md:mx-auto">
        <div class=" text-center mt-10  font-bold text-darkBackgroundColor text-3xl">How to Deedle</div>
        <div class="flex flex-col space-y-3">
            <p class="font-bold">Step 1</p>
            <p>Reveal the Deedle</p>
            <div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor"></div>
            <p class="font-bold">Step 2</p>
            <p>Do the Deedle</p>
            <div class="border-b-2 border-lightDividerColor dark:border-darkDividerColor"></div>
            <p class="font-bold">Step 3</p>
            <div class=" flex space-x-3 items-center ">
                <p>Click</p>
                <img src="img/right_arrow.svg" alt="" class="mx-3 w-2 h-2" />
                <div class="p-2 bg-darkBackgroundColor text-lightBackgroundColor">Deedle Done</div>
            </div>
        </div>
        <div class="flex justify-center">
            <button @click="changeRoute" class="w-full border-darkBackgroundColor active:bg-darkBackgroundColor active:text-lightBackgroundColor  border-4 flex justify-center items-center py-2  w-64">OK!</button>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
    },
    methods: {
        changeRoute(){
            window.localStorage.setItem("hasWatchedTutorial","1");
            window.location.hash = '/deedle';
        }
    }
}
</script>