<template> 
    <div>
        <sidebar></sidebar>
        <div class="container main-wall">
            <navbar></navbar>
            <router-view></router-view>
        </div>
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
    import sidebar from './templates/sidebar'
    import navbar from './templates/navbar'
    export default {
        components: { sidebar, navbar },
    }
</script>