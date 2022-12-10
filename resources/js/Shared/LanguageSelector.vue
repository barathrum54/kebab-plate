<template>
    <div class="ml-4">
        {{__('settings.language')}}
        <Link class="group flex items-center py-3" :href="('/language/'+languageSelected)">
        <icon :name="languageSelected" class="mr-2 w-8 h-8"/>
        </Link>
    </div>
</template>

<script setup>
import Icon from '@/Shared/Icon'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const languageSelected = computed(() => {
    let locale = usePage().props.value.locale;
    if (locale == 'en') {
        return 'tr';
    }else{
        return 'en';
    }
})

</script>
