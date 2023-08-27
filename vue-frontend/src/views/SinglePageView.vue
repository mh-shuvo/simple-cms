<template>
    <div>
        <!-- If errorMessage is not empty, show the error message -->
        <div v-if="errorMessage !== null">
            <p>{{ errorMessage }}</p>
        </div>

        <!-- If errorMessage is null, show loading or data -->
        <div v-else>
            <div v-if="page.title !== null">
                <h1>{{ page.title }}</h1>
                <p class="mb-10">{{ page.content }}</p>
                <p class="mb-10"><b class="bold">Meta Title:</b> {{ page.meta_title }}</p>
                <p class="mb-10"><b class="bold">Meta Description:</b> {{ page.meta_description }}</p>
                <p class="mb-10">
                    <b class="bold">Meta Keywords: </b>
                    <span class="badge" v-for="(keyword, index) in (page.meta_keywords).split(',')" :key="index">{{ keyword }}</span>
                </p>
            </div>
            <div v-else>
                Data is loading...
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const page = ref({
    title: null,
    content: null,
    meta_title: null,
    meta_description: null,
    meta_keywords: null
})

const errorMessage = ref(null)

// Use the VITE_APP_API_ENDPOINT environment variable
const apiEndpoint = import.meta.env.VITE_APP_API_ENDPOINT

const fetchData = async () => {
    try {
        const slug = route.params.slug
        const response = await fetch(`${apiEndpoint}/pages/${slug}`)
        const responseData = await response.json()

        // Check if the response status is not 200 (error)
        if (response.status !== 200) {
            errorMessage.value = responseData.message
        } else {
            page.value = responseData.data
        }

    } catch (error) {
        console.error(error)
        errorMessage.value = 'An error occurred while fetching data.'
    }
}

// Fetch data when the component is mounted
onMounted(() => {
    fetchData()
})
</script>

<style>
    .bold{
        font-weight: bold;
    }
    .mb-10{
        margin-bottom: 10px;
    }
    .badge{
        padding: 3px 5px;
        background: #494444;
        border-radius: 10px;
        margin: 5px;
    }
</style>
