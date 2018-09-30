<style scoped>
    .slug-widget{
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .wrapper {
        margin-left: 7px;
    }
    .slug {
        background-color: #fdfd96;
        padding: 3px 5px;
    }
</style>


<template>
    <div class="slug-widget">
        <div class="icon-wrapper wrapper">
            <i class="fa fa-link"></i>
        </div>

        <div class="url-wrapper wrapper">
            <span class="root-url">http://mainurl.com</span
            ><span class="subdirectory-url">/blog/</span
            ><span class="slug">coolest-post-ever</span>
        </div>

        <div class="button-wrapper wrapper">
            <button class="save-slug-button button">Save</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            url: {
                type: String,
                required: true,
            },
            subdirectory: {
                type: String,
                required: true,
            },
            title: {
                type: String,
                required: true
            },
        },
        data: {
            
        },
        mounted() {
            
        }
    }
</script>
