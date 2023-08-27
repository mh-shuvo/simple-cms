<script setup>
import WelcomeItem from './WelcomeItem.vue'
import EcosystemIcon from './icons/IconEcosystem.vue'
import { ref, onMounted } from 'vue'

// Define a ref to store the fetched data
const data = ref({
    success: false,
    data: [],
    message: ''
})
// Use the VUE_APP_API_ENDPOINT environment variable
const apiEndpoint = import.meta.env.VITE_APP_API_ENDPOINT
// Fetch data from the API
const fetchData = async () => {
    try {
        const response = await fetch(`${apiEndpoint}/pages`)
        const responseData = await response.json()

        // Update the ref with the fetched data
        data.value = responseData
    } catch (error) {
        console.error('Error fetching data:', error)
    }
}

// Fetch data when the component is mounted
onMounted(() => {
    fetchData()
})
</script>

<template>
    <WelcomeItem v-for="page in data.data" :key="page.slug">
        <template #icon>
            <EcosystemIcon />
        </template>
        <template #heading>
            <RouterLink :to="`pages/${page.slug}`">{{ page.title }}</RouterLink>
        </template>
    </WelcomeItem>
</template>
