<template>  
    <div>   
        <greeting></greeting>
    </div>
</template>




<style scoped>
    .main-wall {
        border: none;
        max-width: 100%;
        margin-right:auto;
    }
</style>


<script>
    import greeting from '../templates/main'
    export default {
        components: { greeting },
    }
</script>